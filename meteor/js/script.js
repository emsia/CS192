 function changeBox()
 {
    document.getElementById('one').style.display='none';
    document.getElementById('two').style.display='';
    document.getElementById('password').focus();
 }
 function restoreBox()
 {
    if(document.getElementById('password').value=='')
    {
      document.getElementById('one').style.display='';
      document.getElementById('two').style.display='none';
    }
 }
 
 function changeBox2()
 {
    document.getElementById('one2').style.display='none';
    document.getElementById('two2').style.display='';
    document.getElementById('email').focus();
 }
 function restoreBox2()
 {
    if(document.getElementById('email').value=='')
    {
      document.getElementById('one2').style.display='';
      document.getElementById('two2').style.display='none';
    }
 }
 
