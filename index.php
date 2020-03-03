<?php
require_once "TaskBoard.php";

$projectName = "StartTuts";
$taskBoard = new TaskBoard();
$statusResult = $taskBoard->getAllStatus();
?>
<html>
<head>
<title>Project Management Task Board</title>
<link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
body {
    font-family: arial;

}
.task-board {
    background: #00bfff;
    display: inline-block;
    padding: 100px;
    border-radius: 3px;
    width: 1000px;
    white-space: nowrap;
    overflow-x: scroll;
    min-height: 300px;
}

.header-task{
   width: 1000px;
   padding: 10px;
   font-weight: bold;
  color:#4000ff;
  font-size: 50px;
  text-align:center;
 
}

.status-card {
    width: 250px;
    margin-right: 8px;
    background: #e2e4e6;
    border-radius: 3px;
    display: inline-block;
    vertical-align: top;
    font-size: 1.5em;
}

.status-card:last-child {
    margin-right: 10px;
}

.card-header {
    width: 100%;
    padding: 10px 10px 0px 10px;
    box-sizing: border-box;
    border-radius: 3px;
    display: block;
    font-weight: bold;
}

.card-header-text {
    display: block;
}

ul.sortable {
    padding-bottom: 10px;
}

ul.sortable li:last-child {
    margin-bottom: 0px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0px;
}

.text-row {
    padding: 15px 10px;
    margin: 10px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 3px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    font-size: 0.8em;
    white-space: normal;
    line-height: 20px;
}

.ui-sortable-placeholder {
    visibility: inherit !important;
    background: transparent;
    border: #666 2px dashed;
}
</style>
</head>
<body>
        <div class="task-board">

        <h1 class = "header-task">Task Board</h1>
            <?php
            foreach ($statusResult as $statusRow) {
                $taskResult = $taskBoard->getProjectTaskByStatus($statusRow["id"], $projectName);
                ?>
                <div class="status-card">
                    <div class="card-header">
                        <span class="card-header-text"><?php echo $statusRow["status_name"]; ?></span>
                    </div>
                    <ul class="sortable ui-sortable"
                        id="sort<?php echo $statusRow["id"]; ?>"
                        data-status-id="<?php echo $statusRow["id"]; ?>">
                <?php
                if (! empty($taskResult)) {
                    foreach ($taskResult as $taskRow) {
                        ?>
                
                     <li class="text-row ui-sortable-handle"
                            data-task-id="<?php echo $taskRow["id"]; ?>"><?php echo $taskRow["title"]; ?></li>
                <?php
                    }
                }
                ?>
                                                 </ul>
                </div>
                <?php
            }
            ?>
        </div>
    <script>
 $( function() {
     var url = 'edit-status.php';
     $('ul[id^="sort"]').sortable({
         connectWith: ".sortable",
         receive: function (e, ui) {
             var status_id = $(ui.item).parent(".sortable").data("status-id");
             var task_id = $(ui.item).data("task-id");
             $.ajax({
                 url: url+'?status_id='+status_id+'&task_id='+task_id,
                 success: function(response){
                     }
             });
             }
     
     }).disableSelection();
     } );
  </script>
</body>
</html>