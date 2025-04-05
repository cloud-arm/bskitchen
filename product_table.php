  <?php
  include("config.php");

  $str = $_GET['str'];

  if ($str == 'all') {
    $result = select_query("SELECT * FROM products WHERE  dll = 0 ORDER by id DESC ");
  } else  if ($str == 'Materials') {
    $result = select_query("SELECT * FROM products WHERE  dll = 0 AND type = 'Materials'  ORDER by id DESC ");
  } else  if ($str == 'dish') {
    $result = select_query("SELECT * FROM products WHERE  dll = 0 AND type = 'dish'  ORDER by id DESC ");
  } else {
    $result = select_query("SELECT * FROM products WHERE  dll = 0 AND (`product_code` LIKE '%" . $str . "%') OR (`product_name` LIKE '%" . $str . "%')  ORDER BY id DESC ");
  }
  for ($i = 0; $row = $result->fetch(); $i++) {
    $id = $row['id'];
  ?>
    <tr class="record">
      <td><?php echo $row['id']; ?></td>

      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_code']; ?></td>
      <td><?php echo $row['cat']; ?></td>

      <td>
        <a href="product_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
      </td>

    </tr>
  <?php  }  ?>