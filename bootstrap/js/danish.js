
function OnStart()
{
document.getElementById('memo').focus();
if(app.FolderExists('/sdcard/Android/dn'))
{
if(app.FileExists('/sdcard/Android/dn/index.txt'))
{
var txt=app.ReadFile("/sdcard/Android/dn/index.txt");
document.getElementById('display').innerHTML=txt;
}
else
app.WriteFile("/sdcard/Android/dn/index.txt","");
}
else
{
app.MakeFolder("/sdcard/Android/dn")
app.WriteFile("/sdcard/Android/dn/index.txt","");
}
}

function save()
{
var text=document.getElementById('memo').value;
if(text=="")
alert("KUCH TO LIKH BE!!")
else
{
text="<li class='list-group-item' onclick='copy('"+text+"')'>"+text+"</li>";
var textOld=app.ReadFile("/sdcard/Android/dn/index.txt");
var textNew=text + textOld;
app.WriteFile("/sdcard/Android/dn/index.txt",textNew);
document.getElementById('display').innerHTML=textNew;
}
}


function remove()
{
var ans=prompt("ARE YOU SURE ? ALL PREVIOUS MEMO'S WILL BE DELETED!!");
if(ans=="Skdanishbhai")
{
app.DeleteFile("/sdcard/Android/dn/index.txt");
app.WriteFile("/sdcard/Android/dn/index.txt","");
}
else
alert("PASSWORD WRONG HAI BE CHUTIYE!!");
}


function refresh()
{
var text=app.ReadFile("/sdcard/Android/dn/index.txt");
if(text=="")
document.getElementById('display').innerHTML="";
else
document.getElementById('display').innerHTML=text;
}


function copy(a)
{
app.SetClipboardText(a);
app.ShowPopup("TEXT COPIED");
}



