<div class="sidebar bg-light shadow-lg p-4" style="width: 250px; min-height: 100vh;">
    <h4 class="text-center mb-4 text-primary font-weight-bold">Admin Panel</h4>

    <!-- Navigation Links -->
    <div class="nav flex-column">
        <a href="admin.php" class="nav-link text-dark py-3 mb-2 rounded-pill hover-shadow">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
    </div>
    <div class="accordion mb-3" id="reportAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingReports">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseReports" aria-controls="collapseReports" aria-expanded="false">
                    Reports
                </button>
            </h2>
            <div id="collapseReports" class="accordion-collapse collapse" aria-labelledby="headingReports"
                data-bs-parent="#reportAccordion">
                <div class="accordion-body">
                    <a href="dailyreport.php" class="btn btn-outline-primary w-100 mb-2">Daily Report</a>
                    <a href="monthlyreport.php" class="btn btn-outline-primary w-100">Monthly Report</a>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion" id="manageContentAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingManageContent">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseManageContent" aria-expanded="false" aria-controls="collapseManageContent">
                    Add Content
                </button>
            </h2>
            <div id="collapseManageContent" class="accordion-collapse collapse" aria-labelledby="headingManageContent"
                data-bs-parent="#manageContentAccordion">
                <div class="accordion-body d-flex flex-column">
                    <a href="admin_offer.php" class="nav-link text-dark py-2 mb-2 rounded-pill hover-shadow">
                        <i class="bi bi-plus-lg me-2"></i>Offers
                    </a>
                    <a href="admin_gallery.php" class="nav-link text-dark py-2 mb-2 rounded-pill hover-shadow">
                        <i class="bi bi-plus-lg me-2"></i>Gallery
                    </a>
                    <a href="admin_blog.php" class="nav-link text-dark py-2 rounded-pill hover-shadow">
                        <i class="bi bi-plus-lg me-2"></i>Blogs
                    </a>
                </div>
            </div>
        </div>
    </div>




    <!-- Logout Button -->
    <div class="mt-4">
        <a href="?logout=true"
            class="btn btn-danger w-100 rounded-pill py-3 d-flex justify-content-center align-items-center hover-shadow text-white">
            <i class="bi bi-box-arrow-right me-2 text-white"></i> Logout
        </a>
    </div>

</div>