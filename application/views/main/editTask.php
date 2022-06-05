<h1 class="title">Редактирование записи</h1>

<div class="form-container">
    <form class="edit-form" action="/edit/<?=$vars[0]['id']?>" method="post">
        <div class="input-form-container">
            <span>описание</span>
            
            <input name="description" type="text" value="<?=$vars[0]['description']?>">
        </div>

        <div class="input-form-container">
            <span>исполнитель</span>
            
            <input name="assignee" type="text" value="<?=$vars[0]['assignee']?>">
        </div>

        <div class="input-form-container">
            <span>email</span>
            
            <input name="email" type="text" value="<?=$vars[0]['email']?>">
        </div>

        <input name="ready" type="hidden" value="<?=$vars[0]['ready']?>">

        <button type="submit">Изменить</button>
    </form>
</div>