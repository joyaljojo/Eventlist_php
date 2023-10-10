<?php 
  require 'function.php';

  $events = getEvents();  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
      $eventIdToDelete = $_POST['id'];
      if (deleteEvent($eventIdToDelete)) {
        
        header('Location: index.php');
        exit();
    }  
    }
  }// Retrieve all events
?>

<?php require 'head.php'; ?>
<body>
  <main class="container mb-5">
    <?php require 'header.php'; ?>
    <div class="row">
      
      <?php foreach ($events as $event) { ?>
      <!-- Event Card -->
      <div class="col col-lg-4">
        <div class="card m-3">
          <div class="card-img-top bg-secondary-subtle fs-1 d-grid justify-content-center align-content-center p-5">
            <i class="bi bi-calendar-check"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title mb-3"><?php echo $event['title']; ?></h5>
            <p class="card-text text-danger mb-3"><?php echo date('D, M j, Y', strtotime($event['date'])); ?></p>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $event['email']; ?></h6>
            <div class="d-flex justify-content-center mt-5">
              <form method="post">
                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Event Card -->
      <?php } ?>

    </div>
  </main>
</body>
</html>






