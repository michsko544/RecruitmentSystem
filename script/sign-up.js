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
    // $(`#sform-${i+1}`).submit(function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url:'',
    //         type:'post',
    //         data:$(`#sform-${i+1}`).serialize(),
    //         success:function(){
    //             console.log("Poprawnie wypelniony");
    //             hideDiv(document.getElementById(`sign-up-${i+1}`).id);
    //             console.log(`chowam ${i+1}`);
    //             showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id);
    //             console.log(`pokazuje ${i+2}`);
    //         }
    //     });
    // });
}

document.getElementById("no-experience").addEventListener("click", function(){
    if(this.checked===true){
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=false : console.log(false)}); 

        hideDiv("btn-experiance");
    } else {
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=true : console.log(false)});

        showDiv("btn-experiance--hidden");
    }
});

