<?php
include("./templates/up_part.php");
include("./classes/orders_db_class.php");

$order_db = new Order_db();
if(isset($_GET["page"])){
  if(empty($_GET["page"])){
    $page = 1;
  }else{
    try{
      $page = intval($_GET["page"]);
      if(intval($_GET["page"])<=0){
        $page = 1;
      }
    }catch(Exception $e){
      $page = 1;
    }
  }
}else{
  $page = 1;
}

$total_orders_on_page = 50;
$result = $order_db->load_orders(abs(($page-1)*$total_orders_on_page),$total_orders_on_page);
$data = $result["data"];
?>
          <div class="home_main">
            <h3>შეკვეთები</h3>
            <div class="orders-container">
              <div class="table_class">
                <?php if(sizeof($data)>0){ ?>
                 <table style="" class="table table-bordered myadd">
                    <thead>
                      <tr>
                        <th scope="col">სახელი, გვარი</th>
                        <th scope="col">ტ.ნომერი</th>
                        <th scope="col">დასახელება</th>
                        <th scope="col">თარიღი</th>
                        <th scope="col">იპ.მისამართი</th>
                        <th scope="col"><img class="done" src="./images/completed.png" alt=""></th>
                        <th scope="col">წაშლა</th>
                        <th scope="col">ლინკი</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data as $order){ ?>
                      <tr>
                          <td><?php echo htmlspecialchars($order[1]); ?></td>
                          <td><?php echo htmlspecialchars($order[2]); ?></td>
                          <td class="pr_name"><?php echo htmlspecialchars($order[7]); ?> </td>
                          <td><?php echo htmlspecialchars($order[3]); ?></td>
                          <td><?php echo htmlspecialchars($order[4]); ?></td>
                          <td><input type="checkbox" id="called" value="" <?php echo ($order[5] == "1") ? "checked" : ''; ?>></td>
                          <td><img id="delete" class="del" src="./images/delete.png" alt=""></td>
                          <td><a class="btn btn-primary" href="../?id=<?php echo htmlspecialchars($order[6]); ?>" target="_blank">Open</a></td>
                          <input type="hidden" id="order_id" value="<?php echo $order[0]; ?>">
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                <?php } ?>
               </div>
            </div>
            <div class="page_buttons">
              <?php if($page > 1){ ?>
                <a href="./orders.php?page=<?php echo $page-1; ?>"><img class="left" src="./images/arrow.png" alt=""></a>
              <?php } ?>
                <p><?php echo $page; ?></p>
              <?php if(sizeof($data) == $total_orders_on_page){ ?>
                <a href="./orders.php?page=<?php echo $page+1; ?>"><img src="./images/arrow.png" alt=""></a>
              <?php } ?>
            </div>
          </div>
<script src="./scripts/orders.js"></script>
<?php include("./templates/down_part.php"); ?>
