
//저장하기를 누른 상태에서 함수문
function check_input(){
    //아이디 작성여부 확인
    if(!document.member_form.id.value){
        alert("아이디를 입력하세요");
        document.member_form.id.focus();
        //focus : 네이버에서 로그인 박스에 접근시 아이디 박스를 먼저 불이 들어오게 한다. 포커스를 잡는다. (입력상자, 버튼에도 포커스를 줄 수 있음)
        return; //돌아가 return만 작성했을 경우 함수문에서 탈출
    }
    //비밀번호 작성여부 확인
    if(!document.member_form.pass.value){ //name으로 접근
        alert("비밀번호를 입력하세요");
        document.member_form.pass.focus();
        return; 
    }
    //비밀번호 확인 작성여부 확인
    if(!document.member_form.pass_confirm.value){
        alert("비밀번호 확인을 입력하세요");
        document.member_form.pass_confirm.focus();
        return; 
    }
    //이름 작성여부 확인
    if(!document.member_form.name.value){
        alert("이름을 입력하세요");
        document.member_form.name.focus();
        return; 
    }
    //이메일 작성여부 확인
    if(!document.member_form.email1.value){
        alert("이메일을 입력하세요");
        document.member_form.email1.focus();
        return; 
    }
    if(!document.member_form.email2.value){
        alert("이메일을 입력하세요");
        document.member_form.email2.focus();
        return; 
    }

    if(document.member_form.pass.value != document.member_form.pass_confirm.value){
        alert("비밀번호와 비밀번호확인이 일치하지 않습니다. 다시 한번 입력해 주시기 바랍니다.");
        document.member_form.pass.focus();
        return;
    }
    //submit() : 전송을 진행하는 이벤트
    document.member_form.submit();

}


//리셋버튼눌렀을때
function reset_form(){
    document.member_form.id.value = "";  //현존하는 value 값을 제거한다.
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";
    document.member_form.id.focus();
    return;
    //사용자가 초기화(취소하기)를 선택했다는 것은 모든 내용물을 공란으로 만들고 나서 다시 작성하겠다는 의미 내포 가능성이 존재(맨처음으로 돌려준다.)
}



//아이디 중복체크 (사용가능한 아이디인지? 사용불가능한 아이디인지?)
function check_id(){
    window.open("member_check_id.php?id=" + document.member_form.id.value, "checkID", "width=320, height=200, left=600, top=300"); //어디내용을 뽑아와라, get방식을 받아올것임

    //document.member_form.id.value : 아이디와 관련한 인풋박스의 입력값
    //?전은 도메인이고 ?이후 부터는 경로값 id는 내가 그냥 쓴값 뒤에 고객에 쓴값 받아옴
}

// window.open("불러올 화면의 주소", "새로운 페이지에 대한 타이틀", "새로운 브라우저 화면의 환경설정(세로, 가로, 스크린으로 위치정보, 스크롤바, url정보창,리사이즈여부)")





