const fromJsonToProfile = (json) => {
    const pD = json.personalData;
    const exp = json.experience;
    const sql = json.education;
    const skl = json.skills.skills;
    const lang = json.skills.languages;
    const add = json.additional;
    const n = json.counters;

    let titleProps = {
        sender: {id:123, name:"John", surname:"Lemon"},
        position: "Minecrafter"//json.position ? json.position[0] || "" : ""
    }
    addProfileTitle(titleProps);

    let pDProps = {
        firstName: pD.firstName || "siema",
        lastName: pD.lastName || "jestem",
        phone: pD.phone || "marek",
        country: pD.country || "co",
        city: pD.city || "tam"
    };
    addPersonalData(pDProps);

    for(let i = 0; i<n.experience; ++i){
        let props = {
            jobTitle: exp.jobTitle[i],
            employer: exp.employer[i],
            startDate: exp.startDate[i],
            endDate: exp.endDate[i],
            city: exp.city[i],
            description: exp.description[i]
        };
        addExperience(props);
    }

    for(let i = 0; i<n.education; ++i){
        let props = {
            schoolName: sql.schoolName[i],
            specialization: sql.specialization[i],
            startDate: sql.startDate[i],
            endDate: sql.endDate[i],
            city: sql.city[i],
            description: sql.description[i]
        };
        addSchool(props);
    }
        
    for(let i = 0; i<n.skill; ++i){
        let props = {
            skill: skl.skill[i],
            level: skl.level[i]
        };
        addSkill(props);
    }
        
    for(let i = 0; i<n.language; ++i){
        let props = {
            lang: lang.lang[i],
            level: lang.level[i]
        };
        addLanguage(props);
    }
    
    if(n.coverLetter!==0){
        let props = {
            cl: add.coverLetter[0]
        }
        addCL(props);
    }
    
        
    for(let i = 0; i<n.certificate; ++i){
        let props = {
            cert: add.certificates
        }
        addCertificate(props);
    }

    for(let i = 0; i<n.course; ++i){
        let props = {
            course: add.courses[i]
        }
        addCourse(props);
    }

    if(n.cv!==0){
        let props = {
            cv: add.cv[0]
        }
        addCV(props);
    }
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToProfile(data);
}

readJSON("json/profile.json");