const loadMenu = (role) => {
    const menu = document.querySelector(".nav-links");
    let link = document.createElement("li");
    switch(role){
        case "assistant":
            link = document.createElement("li");
            link.innerHTML = "<a href='applicationsW.php'>Applications</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='messagesW.php'>Messages</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='php/log_in/log_out.php'>Sign out</a>";
            menu.appendChild(link);
            break;
        case "recruiter":
            link = document.createElement("li");
            link.innerHTML = "<a href='applicationsW.php'>Applications</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='messagesW.php'>Messages</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='php/log_in/log_out.php'>Sign out</a>";
            menu.appendChild(link);
            break;
        case "manager":
            link = document.createElement("li");
            link.innerHTML = "<a href='applicationsW.php'>Applications</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='messagesW.php'>Messages</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='pdf/rep.php' target='blank'>Generate report</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='php/log_in/log_out.php'>Sign out</a>";
            menu.appendChild(link);
            break;
        case "admin":

            link = document.createElement("li");
            link.innerHTML = "<a href='admin_main.php'>Main page</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='admin_create_user.php'>Add user</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='admin_pick_role.php'>Pick role</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='admin_manage_users.php'>Manage users</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='php/log_in/log_out.php'>Sign out</a>";
            menu.appendChild(link);
            const navLinks = document.querySelectorAll(".nav-links li");
            navLinks.forEach((link, index)=>{
            });

            break;
        default:
            link = document.createElement("li");
            link.innerHTML = "<a href='profile.php'>My profile</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='applications.php'>Applications</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='Replies.php'>Replies</a>";
            menu.appendChild(link);
            link = document.createElement("li");
            link.innerHTML = "<a href='php/log_in/log_out.php'>Sign out</a>";
            menu.appendChild(link);
    }

    var burger = document.getElementById("btn-burger");
    var nav = document.querySelector(".nav-links");
    const navLinks = document.querySelectorAll(".nav-links li");
    var navHelp = document.getElementById("nav-help");

    burger.onclick = () => {
        navHelp.classList.toggle("helper");
        toggleBlur("container");
        document.querySelector(".nav-bar").classList.toggle("fixed")
        nav.classList.toggle("nav-active");

        navLinks.forEach((link, index)=>{
            if(link.style.animation)
                link.style.animation="";
            else
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.1}s`;
        });

        burger.classList.toggle("toggle");
    };
};

