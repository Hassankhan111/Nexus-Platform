document.addEventListener("DOMContentLoaded", async function () {
 // notification link------------------
      const headernotificationbtn = document.getElementById('headernotificationbtn');
           headernotificationbtn.addEventListener("click", function(){
          window.location.href = "/notifications";
        });
      
  const token = localStorage.getItem("api_token");
  if (!token) {
    window.location.href = "/";
    return;
  }

  let id = null;
  let role = null;

  try {

    //-------------------------------
    // 1. GET AUTH USER
    //-------------------------------
    const res = await fetch("/api/user", {
      method: "GET",
      headers: {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
      }
    });

    const response = await res.json();

    if (response.success && response.data) {

      id = response.data.id;
      role = response.data.role.toLowerCase();

      //----------------------------------
      // PROFILE LINK Button in header (Investor / Entrepreneur)
      //----------------------------------
      const profilee = document.getElementById('profilee');
      
     
      if (profilee) {
        profilee.href = (role === "investor")
          ? `/investor_portfolio/${id}`
          : `/profile/entreprenure/${id}`;
      }
      //----------------------------------
      // REDIRECT DASHBOARD LINK
      //----------------------------------
      const dashboardlink = document.getElementById('link_dashbord');
      if (dashboardlink) {
        dashboardlink.href = (role === "investor")
          ? "/Dashboard/Investor"
          : "/Dashboard/entrepreneure";
      }
      //---------------------------------
      // REDIRECT BILLING LINK
      //----------------------------------
      const billinglink = document.getElementById('billings');
      if (billinglink) {
        billinglink.addEventListener("click", function () {
          window.location.href = "/payments";
        });
      }

      //----------------------------------
      // DROPDOWN CLICK PROFILE REDIRECT
      //----------------------------------
      document.getElementById('profileDropdown').addEventListener("click", function (e) {
        e.preventDefault();
        if (role === "investor") {
          window.location.href = `/investor_portfolio/${id}`;
        } else {
          window.location.href = `/profile/entreprenure/${id}`;
        }
      });

      //----------------------------------
      // HEADER USERNAME
      //----------------------------------
      document.getElementById("userdeteils").innerText = response.data.name;
    }

    //-------------------------------
    // 2. SHOW ENTREPRENEUR IMAGE
    //-------------------------------
    if (role === "entrepreneur") {

      const startup_data = await fetch(`/api/enterprenure/${id}`, {
        method: "POST",
        headers: {
          "Authorization": "Bearer " + token,
          "Accept": "application/json"
        }
      });

      const entreprenre_startup = await startup_data.json();

      const entreprenure = entreprenre_startup.startup;
      //console.log(entreprenure.role);
      //console.log(entreprenre_startup.startup.startup);
      if (Array.isArray(entreprenure.startup) && entreprenure.startup.length > 0) {
        const data = entreprenure.startup;
        //console.log(startupname);
        data.forEach((value) => {
          document.getElementById("userImage").src = "/storage/" + value.image;
        });
      }
    }

    //-------------------------------
    // 3. SHOW INVESTOR IMAGE
    //-------------------------------
    if (role === "investor") {

      const inv_startup = await fetch(`/api/investor_portfolio/${id}`, {
        method: "GET",
        headers: {
          "Authorization": "Bearer " + token,
          "Accept": "application/json"
        }
      });

      const investor_data = await inv_startup.json();

      const investors = investor_data.user.inv_startup;
      //console.log(investors);

      if (Array.isArray(investors) && investors.length > 0) {

        investors.forEach(value => {

          if (value.inv_image) {
            //console.log(value.inv_name);
            document.getElementById("userImage").src = "/storage/" + value.inv_image;
          }

        });

      }

    }

  } catch (error) {
    console.error("Error:", error);
  }
  

});
