/*
Extracted form: Niederst, J. Web Design in a Nutshell, 3rd ed. O'Reilly.
*/
var ajax_mychats = {
  myConn: false, // the XMLHttpRequest
  body: false, // the body element
  target: false, // the target container
  loader: false, // the loader
  init: function( controlId, sbmtBtnId, targetId, text_line ){

    if( !document.getElementById ||   !document.getElementsByTagName ||   !document.getElementById( controlId ) ||   !document.getElementsByClassName(sbmtBtnId)  ||    !document.getElementById( targetId ) ) return;
    ajax_mychats.myConn = new XHConn( );
    if( !ajax_mychats.myConn ) return;
    ajax_mychats.body = document.getElementsByTagName( 'body' )[0];
    var control = document.getElementById( controlId );
    var sbmtBtns = document.getElementsByClassName( sbmtBtnId );
    var contenedor = document.getElementById( targetId );
    ajax_mychats.target = document.getElementById( targetId );
    var id_article = '';
    var refreshIntervalId =0;
    var texto='';
    ajax_mychats.loadPage(  );
    for (var i = 0; i < sbmtBtns.length; i++) {

      ajax_mychats.addEvent( sbmtBtns[i], 'click', function( ){
        ajax_mychats.idToLoad = this.id;
        // data from div ID sended by chats/index.php: idarticle, iduser and image profile user
        id_article=this.id;
        //Change Image Profile
        var imagePath = id_article.split('&');
        var message = imagePath[2].split('=')[1];
        if(message.length>0){
        var http = new XMLHttpRequest();
            http.open('HEAD', './resources/profiles/'+message, false);
            http.send();
            if (http.status!==404){
                document.getElementById('myImageProfile').src='./resources/profiles/'+message;
            }else{
                //Default image
                document.getElementById('myImageProfile').src='./resources/icons/ic_chat.svg';
            }
        }else {
            //default image
            document.getElementById('myImageProfile').src='./resources/icons/ic_chat.svg';
        }

        var valuesUser =this.textContent.split('«»');

			  var author = document.getElementById('name');
			  author.innerHTML=ji18n('Chat with') + ' <em>' + valuesUser[1] + '</em> ' + ji18n('about the product') + ' <em>' + valuesUser[0]+'</em>';
        //$('chat-user-name').load('/view/chats/example.php');
      },false);
    };
    ajax_mychats.addEvent( control, 'click', function( ){

      if (document.getElementById( text_line ) ){
        texto = document.getElementById(text_line).value;
      }
      if( texto != '' ){
        ajax_mychats.addNewLine(id_article,texto );
      }
    } );
    //*******************************************************************************************************
  },
  LoaderLoaded: null,
  idToLoad: null,
  loadPage: function( ){ // the Ajax call
    if (ajax_mychats.LoaderLoaded!==null) {ajax_mychats.killLoader( );}
    // let's let the user know something is happening (see below)
    //ajax_mychats.buildLoader( );
    // this is the function that is run once the Ajax call completes
    var fnWhenDone = function(oXML) {
      // get rid of the loader
      // insert the returned address information into the target
      ajax_mychats.target.innerHTML = oXML.responseText;
      var myDiv = document.getElementById("chat-container");
      myDiv.scrollTop = myDiv.scrollHeight;
      if (ajax_mychats.LoaderLoaded!==null) {ajax_mychats.killLoader( );}
    };
    // use XHConn's connect method

    refreshIntervalId = setInterval(function() {
      if (ajax_mychats.idToLoad!==null) {
        var vars = 'controller=chats&action=view&'+ajax_mychats.idToLoad;
        ajax_mychats.myConn.connect( 'index.php', 'GET',  vars, fnWhenDone );
      }
      //	clearInterval(refreshIntervalId);
    }, 2000);
    //ajaxs_mychats.killLoader( );
  },
  addNewLine: function( idarticle,txtToAdd ){
    if (ajax_mychats.LoaderLoaded==null) { ajax_mychats.buildLoader( );}else{ajax_mychats.killLoader( );ajax_mychats.buildLoader( );}
    document.getElementById( 'write-text').value="";
    var fnWhenDone = function() {
      if (ajax_mychats.LoaderLoaded!==null) {ajax_mychats.killLoader( );}
      ajax_mychats.loadPage(idarticle );
    };
    var vars2 = idarticle+'&texto='+txtToAdd;
    //alert(vars2);
    ajax_mychats.myConn.connect( 'index.php?controller=chatLines&action=add_mychats', 'POST',vars2, fnWhenDone );
  },
  buildLoader: function( ){
    // builds a loader
    // create a new div
    ajax_mychats.loader = document.createElement( 'div' );
    // give it some style

    ajax_mychats.loader.style.position = 'absolute';
    ajax_mychats.loader.style.top = '50%';
    ajax_mychats.loader.style.left = '50%';
    ajax_mychats.loader.style.width = '300px';
    ajax_mychats.loader.style.lineHeight = '100px';
    ajax_mychats.loader.style.margin = '-50px 0 0 -150px';
    ajax_mychats.loader.style.textAlign = 'center';
    ajax_mychats.loader.style.border = '1px solid #870108';
    ajax_mychats.loader.style.background = '#fff';
    // give it some text
    //ajax_mychats.loader.appendChild(document.createTextNode( 'Loading Data, please wait\u2026' ) );

    ajax_mychats.loader.appendChild(document.createTextNode( ji18n('Loading Data, please wait') ) );
    // append it to the body
    ajax_mychats.body.appendChild( ajax_mychats.loader );
    ajax_mychats.LoaderLoaded=1;
  },
  killLoader: function( ){
    // kills the loader
    // remove the loader form the body
    ajax_mychats.body.removeChild( ajax_mychats.loader );
    ajax_mychats.LoaderLoaded=null;
  },
  addEvent: function( obj, type, fn ){ // the add event function
    if (obj.addEventListener) obj.addEventListener( type, fn, false );
    else if (obj.attachEvent) {
      obj["e"+type+fn] = fn;
      obj[type+fn] = function( ) {
        obj["e"+type+fn]( window.event );
      };
      obj.attachEvent( "on"+type, obj[type+fn] );
    }
  }
};












//***********************************************************************************************************
/*
ajax_mychats.addEvent( control, 'click', function( ){
var texto='';
if (document.getElementById( text_line ) ){
texto = document.getElementById(text_line).value;
}
if( texto != '' ){
ajax_mychats.addNewLine( id_article,texto );
}
} );
},
loadPage: function( idarticle ){
//ajax_mychats.buildLoader( );
var fnWhenDone = function(oXML) {
//ajax_mychats.killLoader( );
ajax_mychats.target.innerHTML = oXML.responseText;
};
var vars = 'controller=chats&action=index&'+idarticle;
setInterval(function() {
ajax_mychats.myConn.connect( 'index.php', 'GET',vars, fnWhenDone );
}, 2000);
},
addNewLine: function( idarticle,txtToAdd ){
var fnWhenDone = function(oXML) {
ajax_mychats.target.innerHTML = oXML.responseText;
};
var vars2 = idarticle+'&texto='+txtToAdd;
ajax_mychats.myConn.connect( 'index.php?controller=chatLines&action=add', 'POST',vars2, function() {} );
},
buildLoader: function( ){
ajax_mychats.loader = document.createElement( 'div' );
ajax_mychats.loader.style.position = 'absolute';
ajax_mychats.loader.style.top = '50%';
ajax_mychats.loader.style.left = '50%';
ajax_mychats.loader.style.width = '300px';
ajax_mychats.loader.style.lineHeight = '100px';
ajax_mychats.loader.style.margin = '-50px 0 0 -150px';
ajax_mychats.loader.style.textAlign = 'center';
ajax_mychats.loader.style.border = '1px solid #870108';
ajax_mychats.loader.style.background = '#fff';
ajax_mychats.loader.appendChild(document.createTextNode( 'Loading Data, please wait\u2026' ) );
ajax_mychats.body.appendChild( ajax_mychats.loader );
},
killLoader: function( ){
ajax_mychats.body.removeChild( ajax_mychats.loader );
},
addEvent: function( obj, type, fn ){
if (obj.addEventListener) obj.addEventListener( type, fn, false );
else if (obj.attachEvent) {
obj["e"+type+fn] = fn;
obj[type+fn] = function( ) {
obj["e"+type+fn]( window.event );
};
obj.attachEvent( "on"+type, obj[type+fn] );
}
}
};
*/
ajax_mychats.addEvent( window, 'load', function( ){
  ajax_mychats.init( 'send-text','article-User-ListItem','chat-container','write-text' );
} );
