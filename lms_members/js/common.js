'use strict';

$(function () {
 
 var $win = $(window);
 var $body = $('body');
 
 /******************************
  jQuery
 ******************************/

 /******************************
  アコーディオン
 ******************************/
 $('body').on('click', '.acd-btn', function() {
  var $this = $(this);
  var $acdBody = $this.parents('.acd-box').find('.acd-body');
  // 閉じていた場合
  if(!$this.hasClass('on')) {
   $this.addClass('on');
   $acdBody.slideDown(function() {
    $acdBody.addClass('on');
   });
  } else {
   // 開いていた場合
   $this.removeClass('on');
   $acdBody.slideUp(function() {
    $acdBody.removeClass('on');
   });
  }
 });
 
 /******************************
  モーダル
 ******************************/
 $('body').on('click', '.modal-pin',function(){
  var $this = $(this),
      id,
      $idElm,
      $overlayBox,
      st;
  
  if($this.hasClass('disabled')) {
   return false;
  } else {
   id = $this.attr('data-id');
   $idElm = $('#'+id);
   $overlayBox = $idElm.parents('.overlay-box');
   $idElm.addClass('on');
   st = $(window).scrollTop();
   
   if($('body').hasClass('sp-vis')) {
    $('html').addClass('ovlay-sp');
   } else {
    $('html').addClass('ovlay');
   }

   $('body').css('top', (-st)+'px');
   
   $('.modal-base').off('click.modal-base').on('click.modal-base', function(e){
    e.stopPropagation();
   });
   
   $overlayBox.fadeIn('slow');
   $('.overlay-bg').fadeIn('slow',function(){
    if($('body').hasClass('ad-df')){
     $('html').addClass('ovlay-ad');
    }
   });
   $('.modal-base').show();
  }
  
  // 閉じるボタンをclickした時のみモーダルを非表示にする場合
  if($overlayBox.hasClass('strict')) {
   $('.overlay-box, .close-btn, .tx-close-btn').off('click.modal-close');
   $('.close-btn, .tx-close-btn').on('click.modal-close', function(){
    hideModal($idElm, st);
   });
  } else {
   // 閉じるボタンや背景などをclickした時にモーダルを非表示にする場合
   $('.overlay-box, .close-btn, .tx-close-btn').off('click.modal-close').on('click.modal-close', function(){
    hideModal($idElm, st);
   });
  }
  return false;
 });
 
 /******************************
  Vue
 ******************************/

 // JSON取得用URL
 var JSON_URL = $('#COMMON_JS').attr('data-json-url');
 var NEWS_LIST_URL = $('#COMMON_JS').attr('data-posts-json-url') != null && $('#COMMON_JS').attr('data-posts-json-url') !== '' ? $('#COMMON_JS').attr('data-posts-json-url') : false;
 
 var mixin = {
  ajax:{
   data:{
    // エラー状態
    error:0,
    // 通信状態
    loading:true,
    // 取得結果格納用
    resultJson:{},
    resultNewsList:{}
   },
   methods:{
    getData:function(){
     var _this = this;
     _this.loading = true;
     $.ajax({
      url: _this.request.jsonUrl,
      type: 'GET',
      dataType: 'JSON',
      timeout : 30000,
     })
     .done(function(response) {
      // JSONが取得できた場合
      
      // 結果をresultに格納し、各種状態管理用の変数を完了ステータスに変更する
      _this.resultJson = response;
      _this.error = 0;
      
      // お知らせ一覧を取得する必要がある場合
      if(_this.newsListFlg === 1) {
       // お知らせ一覧を取得
       $.ajax({
        url: _this.request.newsListUrl,
        type: 'GET',
        dataType: 'JSON',
        timeout : 30000,
       })
       .done(function(response) {
        // JSONが取得できた場合
        
        // 結果をresultに格納し、各種状態管理用の変数を完了ステータスに変更する
        _this.resultNewsList = response;
        _this.error = 0;
        _this.loading = false;
       })
       .fail(function(error) {
        // JSONが取得できなかった場合
        // エラー回数をインクリメント
        _this.error++;
        // エラー回数が規定値以下の場合
        if(_this.error < 3) {
         // 再度取得処理を行う
         _this.getData();
        } else {
         // エラー回数が規定値を超えた場合
         // 状態管理用の変数を更新し、エラーページに遷移する
         _this.error = true;
        }
       });
      } else {
       // お知らせ一覧を取得する必要がない場合
       _this.loading = false;
      }
     })
     .fail(function(error) {
      // JSONが取得できなかった場合
      // エラー回数をインクリメント
      _this.error++;
      // エラー回数が規定値以下の場合
      if(_this.error < 3){
       // 再度取得処理を行う
       _this.getData();
      }else{
       // エラー回数が規定値を超えた場合
       // 状態管理用の変数を更新し、エラーページに遷移する
       _this.error = true;
       // location.href = PROTOCOL + DOMEIN + '/error.aspx';
      }
     });
    }
   },
   mounted:function(){
    // Ajaxを実行
    this.getData();
   }
  }
 }

 var vue = new Vue({
  el: '#VUE_APP',
  mixins: [mixin.ajax],
  data: {
   showMenu: false,
   winY: 0,
   newsListFlg: 0,
   request:{
    jsonUrl: JSON_URL,
    newsListUrl: NEWS_LIST_URL
   },
   selfCheck: [],
   selfCheckScore: 0,
   isSelfCheckAns: false
  },
  created: function() {
   if(this.request.newsListUrl !== false) {
    this.newsListFlg = 1;
   }
  },
  methods: {
   // SPメニューボタン押下時の処理
   toggleMenu: function() {
    // メニューが閉じていた場合
    if(this.showMenu) {
     this.showMenu = false;
     $body.removeClass('m-op').css('top','');
     $win.scrollTop(this.winY);
    } else {
     // メニューが開いていた場合
     this.winY = $win.scrollTop();
     this.showMenu = true;
     $body.addClass('m-op').css('top', '-' + this.winY + 'px');
    }
   },
   // 日付フォーマットを置換する処理
   dateFormat: function(date) {
    return date.slice(0, 10).replace(/-/g, '/');
   },
   // セルフチェックに回答する時の処理
   selfCheckAnswer: function() {
    this.isSelfCheckAns = true;
    setTimeout(function() {
     $('.overlay-box').animate({scrollTop:$('.modal-box.on .self-check-box .question-box').outerHeight()}, 600, 'swing');
    }, 10);
   },
   // セルフチェックモーダルを閉じる時の処理
   closeSelfCheck: function() {
    this.selfCheck = [];
    this.isSelfCheckAns = false;
   }
  },
  watch: {
   // セルフチェックラジオボタン押下時の処理
   selfCheck: function() {
    this.selfCheckScore = 0;
    this.isSelfCheckAns = false;
    for(var i = 0; i < this.selfCheck.length; i++) {
     var num = this.selfCheck[i];
     if(num != null && num !== '' && !isNaN(num)) {
      this.selfCheckScore += Number(num);
     }
    }
   }
  }
 });
});

// Ajaxで取得した結果を格納する処理
function setResult(result, response) {
 result = response;
}

/*------------------------------------------
 Utils
--------------------------------------------*/

/*------------------------------------------
 modal
--------------------------------------------*/
// モーダルを非表示にする処理
function hideModal($idElm, st) {
 $('.modal-base').hide();
 $('.overlay-box, .overlay-bg').fadeOut('slow',function(){
  $idElm.removeClass('on');
  $('.modal-base .btn-box').removeClass('nodisp');
  $('html').removeClass();
  $('body').css('top', '');
  $(window).scrollTop(st);
 });
}