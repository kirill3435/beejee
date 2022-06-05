<h1 class="title">Список задач</h1>

<h2>сортировка</h2>

<div class="sort-btns">
    <div class="sort" data-sort-type="email">Email</div>
    <div class="sort" data-sort-type="ready">статус</div>
    <div class="sort" data-sort-type="assignee">Исполнитель</div>
</div>
<br>

<?foreach ($vars['tasks'] as $task) {?>
    <div class="task">
        <? if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {?>
            <form id="readyMark" action="/taskMarkedReady" method="post">
                <input name="id" type="hidden" value=<?=$task['id']?>>

                <input name="ready" type="hidden" value="<?=$task['ready']?>">

                <button class="mark-ready" type="submit"><?=($task['ready'] == 1) ? 'выполнена' : 'не выполнена';?></button>
            </form>
        <?}?>
        <div>
            <?=$task['description']?>
        </div>

        <div>
            <?=$task['assignee']?>
        </div>

        <div>
            <?=$task['email']?>
        </div>

    <? if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {?>
        <a href="edit/<?=$task['id']?>">редактировать</a>
        <?}?>
    </div>
    <br>
<?}?>

<div class="add-btn-container">
    <a href="/add">
        добавить задачу
    </a>
</div>
<div>
    <?if ($vars['count'] > 3) {?>
        <?if ($vars['count'] % 3 != 0) {
            $pagesCount = intdiv($vars['count'], 3) + 1;
        } else {
            $pagesCount = $vars['count'] / 3;
        }
        if (isset($_GET["PAGE"])) {
            $activePage = (int)htmlspecialchars($_GET["PAGE"]);
        } else {
            $activePage = 1;
        }?>
        <div class="pagination">
        <?for ($i=1; $i<=$pagesCount; $i++)  {?>
            &nbsp;<div class="pagination-btn<?if ($activePage == $i) {echo ' active';}?>" data-pg-id="<?=$i?>"><?=$i?></div>&nbsp;
        <?}?>
        </div>
    <?}?>
</div>
