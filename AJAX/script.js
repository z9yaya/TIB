if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("fileCheck.php");
    source.onmessage = function(event) {
        loadDoc();
    };
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}

function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

function AutoCheck()
{
    if (document.getElementById("id"))
        {
            setTimeout(function(){ loadDoc(); AutoCheck(); }, 60000);
        }
    
}
function loadDoc(creator = email, receiver = user) 
    {
        if (email!='' && user !='')
            {
            console.log("LOADING DOC");
            var file = creator+"-"+receiver+".xml";
            if (!UrlExists(file))
                {
                    var possibleFile = receiver+"-"+creator+".xml";
                    if (!UrlExists(possibleFile))
                        {
                            pushChanges(false, file);
                        }
                    else
                        {
                            file = possibleFile;
                        }
                }
            var enter = document.getElementById("submitText");  
            enter.setAttribute("onClick","pushChanges(true, '" + file + "')");
            var chat =  document.getElementById("id");
            var xhttp;
            if (window.XMLHttpRequest)
                {
                    xhttp = new XMLHttpRequest();
                }
            xhttp.onreadystatechange = function(){
                 if (this.readyState == 4 && this.status == 200 && this.status != 404)
                        {
                            if (chat.innerHTML != xhttp.responseText)
                                {
                                    chat.innerHTML = xhttp.responseText;
                                    if (chat.scrollTop != chat.scrollHeight)
                                        {
                                    chat.scrollTop = chat.scrollHeight;
                                        }
                                }

                        }
            };
            xhttp.open("POST", file, true);
            xhttp.send();
            //AutoCheck();
            }
    }

function pushChanges(exist = true, Document)
{
    console.log("CREATING/PUSHING");
    if (email)
        {
            if (exist)
                {
                    console.log(exist);
                    var chat =  document.getElementById("id");
                    var input = document.getElementById("chat_input").value;
                    if (input != '')
                        {
                        var d = new Date();
                        var currentTime = d.getTime();
                        var timestamp = new Date(currentTime)
                        var minutes = timestamp.getMinutes();
                        var time = timestamp.getHours() + ':' + timestamp.getMinutes();
                        var formated_input = '<message><div class="container"><div class="' + email + '" title="'+time+'">' + input + '</div></div></message>';
                        var data = 'data='+ formated_input + "&document=" + Document;
                        console.log(data);
                        document.getElementById("chat_input").value='';
                        chat.innerHTML += formated_input;
                        chat.scrollTop = chat.scrollHeight;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function()
                            {
                            if (this.readyState == 4 && this.status == 200)
                                {
                                 response.innerHTML=xmlhttp.responseText;
                                }
                            };
                        xmlhttp.open('POST','save.php', true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send(data);
                        } 
                }
            else if (!exist)
                {
                    var data = 'data='+ '' + "&document=" + Document;
                     var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function()
                            {
                            if (this.readyState == 4 && this.status == 200)
                                {
                                 response.innerHTML=xmlhttp.responseText;
                                }
                            };
                        xmlhttp.open('POST','save.php', true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send(data);
                }

        }
}



var email = '';
var contacts = '';
var user = '';

function grabSession()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
            {
            if (this.readyState == 4 && this.status == 200)
                {
                    email = xmlhttp.responseText;
                    response.innerHTML = email;
                }
            };
        xmlhttp.open('POST','session.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
}

function loadContacts()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
            {
            if (this.readyState == 4 && this.status == 200)
                {
                    var contacts =  JSON.parse(xmlhttp.responseText);
                    for (var i=0; i< email.length; i++)
                        {
                            contacts_bar.innerHTML += '<div class="contact" onclick=\'openChat("'+contacts[i]["email"]+'")\'>'+contacts[i]["email"]+'</div>';
                        }                    
                }
            };
        xmlhttp.open('POST','load.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
        MakeCss(email, 'originator');
}


function openChat(User)
{
    user = User;
    loadDoc();
    MakeCss(User, 'receiver');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
function MakeCss(className, actor)
{
   
    if (actor == "originator")
        {
        if(!document.getElementById("me"))
            {
            var style = document.createElement('style');
            style.type = 'text/css';
            style.id = 'me';
            style.innerHTML = 'div[class="'+className+'"] { padding-right: 10px; padding-left: 10px; padding-top: 4px; padding-bottom: 6px; background: #016e96; max-width: 70%; color:white; float: right; border-radius: 15px 0px 15px 15px; word-break: break-word; margin-top: 3px; }';
            document.getElementsByTagName('head')[0].appendChild(style);
            }
        }
    else if(actor == 'receiver')
        {
         if(!document.getElementById("you"))
            {
            var style = document.createElement('style');
            style.type = 'text/css';
            style.id = 'you';
            document.getElementsByTagName('head')[0].appendChild(style);
            }
        document.getElementById("you").innerHTML = 'div[class="'+className+'"] {padding-right: 10px; padding-left: 10px; padding-top: 6px; padding-bottom: 6px; background: #f1f0f0; max-width: 70%; color: black; float: left; border-radius: 0px 15px 15px 15px; word-break: break-word; margin-top: 3px;}';       
        }
    console.log(document.getElementsByTagName('head')[0]);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //setTimeout(loadDoc,100);
setTimeout(loadContacts,500);
grabSession();
//setTimeout(function(){MakeCss(email, 'originator')},500);
