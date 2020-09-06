<div class="container">
    <h2>Memos</h2>
    <!-- main content output -->
    <div>
    <!-- add memo form -->
    <div>
        <h4>Memo hinzufügen</h4>
        <form action="<?php echo URL; ?>memos/addmemo" method="POST">
            <input type="hidden" name="memo_id" value= NULL />
            <textarea type="text" name="memo_content" placeholder="Ihr Memo" required> </textarea>
            <input type="hidden" name="fk_user_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <br>
            <!-- <input type="text" name="memo_public" value="1" />            <label>1=öffentlich; 0=privat</label> -->      
                <div>
    <input type="radio" id="publicNo"
     name="memo_public" 
     value=0 checked>
    <label for="publicNo">privat</label>

    <input type="radio" id="publicYes"
     name="memo_public" value=1>
    <label for="publicYes">öffentlich</label>
    </div>
            <br>  
            <input type="submit" name="submit_add_memo" value="Submit" />
        </form>
    </div>
    <!-- mymemos -->
    <h3>Meine Memos</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Memo</td>
                <td>Löschen</td>
                <td>Anzeigen</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($mymemos as $memo) { ?>
                <tr>
                    <td><?php if (isset($memo->memo_id)) echo $memo->memo_id; ?></td>

                    <td><?php if (isset($memo->memo_content)) echo $memo->memo_content; ?></td>
<!-- 
                    <td>
                        <?php if (isset($memo->memo_public)) { ?>
                            <a href="<?php echo $memo->memo_public; ?>"><?php echo $memo->link; ?></a>
                        <?php } ?>
                    </td> -->

                    <td><a href="<?php echo URL . 'memos/deletememo/' . $memo->memo_id; ?>">Löschen</a></td>
                    <td><a href="<?php echo URL . 'memos/showonememo/' . $memo->memo_id; ?>">Anzeigen</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
