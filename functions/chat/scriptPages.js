function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

////////////////////////////////////
function AutoCheck(file)
{
    if (!!window.EventSource)
        {
        if (typeof(sourceNew) != "undefined")
            {
            if (!sourceNew['url'].includes(file))
                {
                    sourceNew.close();
                }
            }
                    sourceNew = new EventSource("../functions/chat/fileCheck.php?file="+file);
                    sourceNew.onmessage = function(event) {
                         loadDoc(undefined, undefined, true);
                    }
        }
    else 
        {
            console.log("Sorry, your browser does not support instant messaging...");
        }
}
/////////////////////////////////////

function loadDoc(creator = email, receiver = user, serverSent = false) 
    {
        if (creator!='' && receiver !='')
            {
            saveLocation = "../functions/chat/"
            var file = creator+"-"+receiver+".xml";
            if (!UrlExists(saveLocation + file))
                {
                    var possibleFile = receiver+"-"+creator+".xml";
                    if (!UrlExists(saveLocation + possibleFile))
                        {
                            pushChanges(false, file, receiver);
                            
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
            xhttp.open("POST", saveLocation+file, true);
            xhttp.send();
            if (serverSent == false)
                {
                    AutoCheck(file);
                }
            return file;
            
            }
    }

function pushChanges(exist = true, Document, user = '')
{
    if (email)
        {
            if (exist)
                {
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
                        document.getElementById("chat_input").value='';
                        chat.innerHTML += formated_input;
                        chat.scrollTop = chat.scrollHeight;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open('POST','../functions/chat/save.php', true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send(data);
                        } 
                }
            else if (!exist)
                {
                    var data = 'data='+ '' + "&document=" + Document  + "&user=" + user;
                     var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open('POST','../functions/chat/save.php', true);
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
                }
            };
        xmlhttp.open('POST','../functions/chat/session.php', true);
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
                    contacts =  JSON.parse(xmlhttp.responseText);
                    for (var i=0; i< email.length; i++)
                        {
                            contacts_bar.innerHTML += '<div class="contact" onclick=\'openChat("'+i+'",this)\' data-myValue="'+contacts[i]["email"]+'">'+contacts[i]["name"]+'</div>';
                        }                    
                }
            };
        xmlhttp.open('POST','../functions/chat/load.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
        MakeCss(email, 'originator');
        CheckMissed();
        setInterval(CheckMissed, 10000);
       
}


function openChat(User, Contact)
{
    if (id.style.display=="none")
        {
            hideChat();
        }
    if (Contact.classList != "contact active")
        {
            var Contacts = document.getElementsByClassName("active");
            if (Contacts.length == 1)
                {
                console.log(Contacts[0]);
                Contacts[0].className = "contact";
                }

            user = contacts[User]['email'];
            loadDoc();
            MakeCss(user, 'receiver');
            document.getElementById("name").innerHTML = contacts[User]['name'];
            messageBox.style.display = "inline-block";
            document.getElementById("chat_input").focus();
            Contact.className = "contact active";
            Contact.classList.remove('unread');
            if (id.scrollTop != id.scrollHeight)
            {
                id.scrollTop = id.scrollHeight;
            }
        }
}

function closeChat()
{
    messageBox.style.display = "none";
    var Contacts = document.getElementsByClassName("active");
    sourceNew.close();
    if (Contacts.length == 1)
        {
        Contacts[0].className = "contact";
        }
}

function hideChat()
{
    if (id.style.display != "none")
        {
            id.style.display = "none";
            chat_input.style.display = "none";
        }
    else
        {
            id.style.display = "block";
            chat_input.style.display = "inline-block";
        }
}

function CheckMissed()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
            {
            if (this.readyState == 4 && this.status == 200)
                {
                    var UserContacts= document.getElementsByClassName("contact");
                    var missed =  JSON.parse(xmlhttp.responseText);
                    for (var i=0; i< missed.length; i++)
                        {
                            if(contacts_title.classList.contains("Hid") && !contacts_title.classList.contains("unreadHid"))
                                {
                                    contacts_title.classList.add("unreadHid");
                                }
                            for (var j = 0; j < UserContacts.length;j++)
                                {
                                    if (missed[i]["file"].includes(UserContacts[j].getAttribute('data-myValue')))
                                        {
                                            UserContacts[j].classList.add('unread');
                                        }
                                }
                        }                    
                }
            };
        xmlhttp.open('POST','../functions/chat/missedCheck.php', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
function stopScroll(block)
{
    if (block == true)
        {
            if (typeof Scroll === 'undefined')
                {
                    Scroll = document.body.scrollTop;
                }            
            document.body.classList.add('noscroll');
            scrollLock = "-"+Scroll+"px";
            document.body.style.top = scrollLock;   
        }
    else if (block == false)
        {
            document.body.classList.remove('noscroll');
            document.body.scrollTop = Scroll;
            delete Scroll;
        }
}

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
}

function HideContactsBar()
{
    if(document.getElementById("contacts_title").classList.contains("Hid"))
        {
            document.getElementById("contacts_title").classList.remove("Hid");
            if(contacts_title.classList.contains("unreadHid"))
                                {
                                    contacts_title.classList.remove("unreadHid");
                                }
            hideContacts.checked = false;
        }
    else
        {
            document.getElementById("contacts_title").classList.add("Hid");
            hideContacts.checked = true;
        }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
setTimeout(loadContacts,500);
grabSession();
//setTimeout(function(){MakeCss(email, 'originator')},500);
