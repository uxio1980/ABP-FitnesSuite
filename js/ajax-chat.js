/*
 Extracted form: Niederst, J. Web Design in a Nutshell, 3rd ed. O'Reilly.
 */
var ajax_chat = {
  myConn: false, // the XMLHttpRequest
  body: false, // the body element
  target: false, // the target container
  loader: false, // the loader
  init: function( controlId, sbmtBtnId, targetId, text_line ){

      if( !document.getElementById ||   !document.getElementsByTagName ||   !document.getElementById( controlId ) ||   !document.getElementById(sbmtBtnId)  ||    !document.getElementById( targetId ) ) return;
      ajax_chat.myConn = new XHConn( );
      if( !ajax_chat.myConn ) return;

      ajax_chat.body = document.getElementsByTagName( 'body' )[0];
      var control = document.getElementById( controlId );
      var sbmtBtn = document.getElementById( sbmtBtnId );

      var id_article = sbmtBtn.value;

      sbmtBtn.parentNode.removeChild( sbmtBtn );
      ajax_chat.target = document.getElementById( targetId );

      ajax_chat.loadPage( id_article );

      ajax_chat.addEvent( control, 'click', function( ){
        var texto='';
        if (document.getElementById( text_line ) ){
          texto = document.getElementById(text_line).value;
        }
    	if( texto != '' ){
    	   ajax_chat.addNewLine( id_article,texto );
    	}
    	} );
      },
      LoaderLoaded: null,
      loadPage: function( idarticle ){
            if (ajax_chat.LoaderLoaded!==null) {ajax_chat.killLoader( );}
            var fnWhenDone = function(oXML) {

                ajax_chat.target.innerHTML = oXML.responseText;
				var myDiv = document.getElementById("chat-container");
			 	myDiv.scrollTop = myDiv.scrollHeight;
				if (ajax_chat.LoaderLoaded!==null) {ajax_chat.killLoader( );}
            };
			/*var vars = 'controller=chats&action=add&idarticle='+idarticle;
            ajax_chat.myConn.connect( 'index.php', 'GET',vars, fnWhenDone );*/
			var vars = 'controller=chats&action=view&idarticle='+idarticle;
            setInterval(function() {

              ajax_chat.myConn.connect( 'index.php', 'GET',vars, fnWhenDone );
				//ajax_chat.loadPage(id );
            }, 2000);
			 //ajax_chat.killLoader( );
      },
      addNewLine: function( idarticle,txtToAdd ){
		   if (ajax_chat.LoaderLoaded==null) { ajax_chat.buildLoader( );}else{ajax_chat.killLoader( );ajax_chat.buildLoader( );}
		   document.getElementById( 'write-text').value="";
           //ajax_chat.buildLoader( );
            var fnWhenDone = function(oXML) {
				if (ajax_chat.LoaderLoaded!==null) {ajax_chat.killLoader( );}
            };
            var vars2 = 'idarticle='+idarticle+'&texto='+txtToAdd;
            ajax_chat.myConn.connect( 'index.php?controller=chatLines&action=add', 'POST',vars2, fnWhenDone );
      },
      buildLoader: function( ){
        ajax_chat.loader = document.createElement( 'div' );
        ajax_chat.loader.style.position = 'absolute';
        ajax_chat.loader.style.top = '50%';
        ajax_chat.loader.style.left = '50%';
        ajax_chat.loader.style.width = '300px';
        ajax_chat.loader.style.lineHeight = '100px';
        ajax_chat.loader.style.margin = '-50px 0 0 -150px';
        ajax_chat.loader.style.textAlign = 'center';
        ajax_chat.loader.style.border = '1px solid #870108';
        ajax_chat.loader.style.background = '#fff';
        ajax_chat.loader.appendChild(document.createTextNode( ji18n('Loading Data, please wait') ) );
        ajax_chat.body.appendChild( ajax_chat.loader );
		ajax_chat.LoaderLoaded=1;
      },
      killLoader: function( ){
        ajax_chat.body.removeChild( ajax_chat.loader );
		ajax_chat.LoaderLoaded=null;
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

ajax_chat.addEvent( window, 'load', function( ){
ajax_chat.init( 'send-text','idarticle-text','chat-container','write-text' );


} );
