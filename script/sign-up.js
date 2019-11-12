var buttons=document.getElementsByClassName("btn");

for(let i=0; i<buttons.length-1; ++i){
    // $(`sform-${i+1}`).submit(function(e) {
    //     // tasks to do 
    //     e.preventDefault();
    //     if(!$(this).valid()){
            
    //         console.log("Poprawnie wypelniony");
    //         hideDiv(document.getElementById(`sign-up-${i+1}`).id);
    //         console.log(`chowam ${i+1}`);
    //         showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id);
    //         console.log(`pokazuje ${i+2}`);
    //     }
    // });
    $(`sform-${i+1}`).submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'',
            type:'post',
            data:$('#myForm').serialize(),
            success:function(){
                console.log("Poprawnie wypelniony");
                hideDiv(document.getElementById(`sign-up-${i+1}`).id);
                console.log(`chowam ${i+1}`);
                showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id);
                console.log(`pokazuje ${i+2}`);
            }
        });
    });
}