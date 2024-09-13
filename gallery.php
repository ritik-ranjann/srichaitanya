<?php include("includes/header/header.php"  );
pageTitle("Gallery"); ?>
<?php include_once("includes/header/header-close.php");
 ?>

<!-- Team Start -->
<div class="col-md-8 mx-auto">
    <div class="gallery">
<?php
// Directory containing images
$imageDir = 'img/gallery/';
$imageFiles = array_diff(scandir($imageDir), array('..', '.'));

// Loop through each image file and display it
foreach ($imageFiles as $file) {
    // Full path to the image
    $filePath = $imageDir . $file;

    // Check if the file is a valid image
    if (is_file($filePath) && @getimagesize($filePath)) {
        echo '<div class="img-box">';
        echo '<img src="' . htmlspecialchars($filePath) . '" alt="" onclick="openModal(\'' . htmlspecialchars($filePath) . '\')" />';
        echo '</div>';
    }
}
?>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
</div>

<!-- <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Gallery</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5 py-3">
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
        </div>
        <div class="row g-5 py-3">
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
        </div>
        <div class="row g-5 py-3">
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="https://placehold.co/600x400" alt="">
                    
                </div>
            </div>
        </div>
    </div> -->
    <!-- Team End -->
    <?php include("includes/footer/footer.php"); ?>


    <style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: hidden; /* Prevent scrollbars */
        background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
        justify-content: center;
        align-items: center;
        z-index: 99999;
    }

    /* Modal Content (Image) */
    .modal-content {
        max-width: 90%; /* Scale down image to fit */
        max-height: 90vh; /* Scale down image to fit within viewport height */
        margin: auto;
        display: block;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 0; /* No extra space for caption */
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10000; /* Ensure close button is on top */
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
    }

    .gallery * {
    width: 100%;
}
.gallery img {
    height: 100%;
    object-fit: cover;
}
.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
    padding: 1rem;
    }
</style>
<script>
    function openModal(src) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "flex"; // Show the modal
        modalImg.src = src;
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none"; // Hide the modal
    }

    // Close the modal if the user clicks anywhere outside of the modal content
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            closeModal(); // Hide the modal
        }
    }
</script>
    
