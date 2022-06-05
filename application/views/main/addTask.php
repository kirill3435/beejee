<h1 class="title">Добавление записи</h1>

<div class="form-container">
    <form class="add-form" action="/add" method="post">
        <div class="input-form-container">
            <span>описание</span>

            <input name="description" type="text">
        </div>
        <div class="input-form-container">
            <span>исполнитель</span>

            <input name="assignee" type="text">
        </div>
        <div class="input-form-container">
            <span>email</span>
            
            <input name="email" type="text">
        </div>
        
        <input name="ready" value="" type="hidden">

        <button type="submit">Добавить</button>
    </form>
</div>