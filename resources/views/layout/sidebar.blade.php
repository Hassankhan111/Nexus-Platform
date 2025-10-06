
 <!-- Sidebar -->
  <div id="sidebarMenu" class="sidebar">
    <ul class="nav flex-column" id="sidebarLinks"></ul>
  

    <h9 class="text-muted text-uppercase small">Settings</h9>
    <ul class="nav flex-column" id="sidebarSettings">
      <li class="nav-item"><a href="/setting" class="nav-link">⚙️ Settings</a></li>
      <li class="nav-item"><a href="/help" class="nav-link">❓ Help & Support</a></li>
    </ul>

  <div class="sidebar-footer">
    <p class="small mb-1 text-muted">Need assistance?</p>
    <h6 class="small fw-bold">Contact Support</h6>
    <a href="mailto:support@businessnexus.com" class="small text-primary">support@businessnexus.com</a>
  </div>
</div>

 <script>
// Sidebar toggle (mobile)
    document.getElementById("sidebarToggle")?.addEventListener("click", function () {
      document.getElementById("sidebarMenu").classList.toggle("show");
    });
    
    // Sidebar toggle (mobile)
    document.getElementById("sidebarToggle")?.addEventListener("click", function () {
      document.getElementById("sidebarMenu").classList.toggle("show");
    });
//---------------end side bar---------------------------------------------------
//get user by role for side bar items
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
          
          const role = response.data.role;
          //console.log(role);
          id = response.data.id;
          //console.log(id);
         
     

    // Simulated user
    var user = {
      id: id,
      role: role 
    };
    // Sidebar items
    var entrepreneurItems = [
      { to: '/entrepreneure', text: '🏠 Dashboard' },
      { to: '/entrepreneur/' + user.id, text: '🏢 My Startup' },
      { to: '/Investor_', text: '💰 Find Investors' },
      { to: '/messages', text: '💬 Messages' },
      { to: '/notifications', text: '🔔 Notifications' },
      { to: '/documents', text: '📄 Documents' },
    ];

    var investorItems = [
      { to: '/Investor', text: '🏠 Dashboard' },
      { to: '/investors/' + user.id, text: '💼 My Portfolio' },
      { to: '/entreprenure_startup', text: '👥 Find Startups' },
      { to: '/messages', text: '💬 Messages' },
      { to: '/notifications', text: '🔔 Notifications' },
      { to: '/deals', text: '📑 Deals' },
    ];

    var sidebarItems = (user.role === "entrepreneur") ? entrepreneurItems : investorItems;

    // Inject sidebar items
    $.each(sidebarItems, function(index, item) {
      $("#sidebarLinks").append(
        '<li class="nav-item"><a href="'+item.to+'" class="nav-link">'+item.text+'</a></li>'
      );
    });

    // Sidebar toggle
    document.getElementById("sidebarToggle")
      ?.addEventListener("click", function () {
        document.getElementById("sidebarMenu").classList.toggle("show");
      });
    }

       } catch (eroro) {
        console.error('my error', eroro);
      }
    });
  </script>