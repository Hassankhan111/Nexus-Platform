// Login check
   
    document.addEventListener("DOMContentLoaded", async function () {
      const token = localStorage.getItem("api_token");
      if (!token) {
        window.location.href = "/";
        return;
      }
      let id = null;

      try {
        const res = await fetch("/api/user", {
          method: "GET",
          headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
          }
        })
        const response = await res.json();
        if (response.success && response.data) {
          //.log(response.data);
          id = response.data.id;
          //console.log(id);
          document.getElementById("userdeteils").innerText = response.data.name;
        }

        const user_profile = await fetch(`/api/profile/${id}`, {
          method: "POST",
          headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
          }
        })
        const result = await user_profile.json();
       // console.log(result);
        if (result.status && result.profile) {
          //console.log(result.profile.name);
           //show image in Dashboard navbar
          document.getElementById("userImage").src = "/storage/" + result.profile.image;
          
        }

          const role = result.profile.role.toLowerCase();
    
//-------------------------- authantication user by role--------------------------------------------
  // === MODE SWITCH ===
        const autoRedirect = false;
        if (autoRedirect) {
          // MODE 1: Auto redirect immediately after login
           if (role === "investor" && window.location.pathname !== "/Investor") {
              window.location.href = "/Investor";
          } else if (role === "entrepreneur" && window.location.pathname !== "/entrepreneure") {
            window.location.href = "/entrepreneure";
          } else {
            window.location.href = "/";
          }
        } else {
          // MODE 2: Stay on current page, just set links
          const dashboardlink = document.getElementById('link_dashbord');
          if (dashboardlink) {
            dashboardlink.href = (role === "investor") ? "/Investor" : "/entrepreneure";
          }

          const profiles = document.getElementById('profilee');
          if (profiles) {
            profiles.href = (role === "investor") ? `/investors/${id}` : `/entrepreneur/${id}`;
          }
//----------------------------------start user profile page by role -------------------------------------------
          //get profile 
         const profileimage = document.getElementById('profileimage');
          const username = document.getElementById('user_name');
          if (profileimage) {
            profileimage.src = "/storage/" +result.profile.image;
          }
           document.getElementById("user_name").innerText = response.data.name;
           document.getElementById("totalInvestments").innerText = result.profile.investment_history;
           document.getElementById("location").innerText = result.profile.location;
//------------------------update user profile seeting page---------------------------------------------------------
           document.getElementById("setting").addEventListener("click", function(e) {
           e.preventDefault();
           //console.log(id);
           window.location.href='/setting';
         });
           document.querySelector("#fullName").value = result.profile.name;
              document.querySelector("#email").value = result.profile.email;
               document.querySelector("#role").value = result.profile.role;
                document.querySelector("#location").value = result.profile.location;
                 document.querySelector("#bio").value = result.profile.bio;
       }    
      } catch (eroro) {
        console.error('my error', eroro);
      }

      
    });