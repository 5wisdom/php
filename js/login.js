function check_input(){
    if(!document.login_form.id.value){//value값이 없다면
        alert("아이디를 입력하세요");
        document.login_form.id.focus();
        return;
    }
    if(!document.login_form.pass.value){//value값이 없다면
        alert("비밀번호를 입력하세요");
        document.login_form.pass.focus();
        return;
    }    
    document.login_form.submit();

}