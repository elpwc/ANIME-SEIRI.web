var langs={
  'empty':{
    'TOPBAR_MYANIMES':'',
    'TOPBAR_ALLANIMES':'',
    'TOPBAR_SEASONANIMES':'',
    'TOPBAR_USERSETTINGS':'',
    'TOPBAR_USERPROFILE':'',
    'TOPBAR_MYMESSAGES':'',
    'TOPBAR_QUIT':''
  },
  'zh-cn':{
    'TOPBAR_MYANIMES':'我的番剧',
    'TOPBAR_ALLANIMES':'所有番剧',
    'TOPBAR_SEASONANIMES':'当季番剧',
    'TOPBAR_USERSETTINGS':'个人设置',
    'TOPBAR_USERPROFILE':'个人资料',
    'TOPBAR_MYMESSAGES':'我的消息',
    'TOPBAR_QUIT':'退出登录'
  },
  'zh-tw':{
    'TOPBAR_MYANIMES':'我的動漫',
    'TOPBAR_ALLANIMES':'所有動漫',
    'TOPBAR_SEASONANIMES':'當季動漫',
    'TOPBAR_USERSETTINGS':'用戶設置',
    'TOPBAR_USERPROFILE':'用戶檔案',
    'TOPBAR_MYMESSAGES':'我的消息',
    'TOPBAR_QUIT':'退出登錄'
  },
  'ja':{
    'TOPBAR_MYANIMES':'見た～いアニメ',
    'TOPBAR_ALLANIMES':'アニメ一覧',
    'TOPBAR_SEASONANIMES':'今季アニメ',
    'TOPBAR_USERSETTINGS':'マイセッティング',
    'TOPBAR_USERPROFILE':'マイプロファイル',
    'TOPBAR_MYMESSAGES':'マイメッセージ',
    'TOPBAR_QUIT':'ログアウト'
  },
  'en':{
    'TOPBAR_MYANIMES':'My Animes',
    'TOPBAR_ALLANIMES':'All Animes',
    'TOPBAR_SEASONANIMES':'Season Animes',
    'TOPBAR_USERSETTINGS':'My Settings',
    'TOPBAR_USERPROFILE':'User Profile',
    'TOPBAR_MYMESSAGES':'My Messages',
    'TOPBAR_QUIT':'Log out'
  },
  'ko':{
    'TOPBAR_MYANIMES':'내 아니메',
    'TOPBAR_ALLANIMES':'모두 아니메',
    'TOPBAR_SEASONANIMES':'햇 아니메',
    'TOPBAR_USERSETTINGS':'내 설정',
    'TOPBAR_USERPROFILE':'유저 프로파일',
    'TOPBAR_MYMESSAGES':'마이 메시지',
    'TOPBAR_QUIT':'로그아웃'
  },
  'kore':{
    'TOPBAR_MYANIMES':'나의 아니메',
    'TOPBAR_ALLANIMES':'모두 아니메',
    'TOPBAR_SEASONANIMES':'햇 아니메',
    'TOPBAR_USERSETTINGS':'나의 設定',
    'TOPBAR_USERPROFILE':'유저 프로파일',
    'TOPBAR_MYMESSAGES':'마이 메시지',
    'TOPBAR_QUIT':'로그아웃'
  }
  
}

var lang='zh-cn';

$(document).ready(function(){
  lang = $('.langlimaina').attr('data-lang');
  console.log(lang);
  $('lang').each(function(){
    var crtl = $(this);
    //console.log(crtl.text());
    crtl.text(langs[lang][crtl.attr('key')]);
  });
});
