<script>
    // Ensure all elements exist before running the script
    let arrow = document.querySelectorAll(".arrow");
    if (arrow.length) {
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; // select main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
    } else {
        console.log("No elements with the class .arrow found.");
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");

    if (sidebarBtn) {
        console.log("Sidebar button found!");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    } else {
        console.log("Sidebar button not found.");
    }
</script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
