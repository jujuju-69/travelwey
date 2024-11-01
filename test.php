<?php
$title = 'Destination';
include 'header.php';
include 'db.php';
$query = $conn->query("SELECT * FROM destination_clicks");
$destinationClicks = $query->fetch_all(MYSQLI_ASSOC);
?>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-4">Destination Click Counts</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Destination</th>
              <th>Click Count</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($destinationClicks as $destinationClick): ?>
              <tr>
                <td><?php echo $destinationClick['destination_name']; ?></td>
                <td><?php echo $destinationClick['click_count']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
