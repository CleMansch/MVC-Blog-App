<div class="container">
    <!-- main content output -->
    <div>
    <!-- mymemos -->
    <h4>Mein Memo</h4>
   <!-- update memo form -->
   <div>
        <form action="<?php echo URL;?>memos/updatememo/<?php foreach ($onememo as $memo) { 
            if (isset($memo->memo_id)) echo $memo->memo_id;
            ?>" 
        method="POST">

                <input type="hidden" name="memo_id" value= <?php if (isset($memo->memo_id)) echo $memo->memo_id;?> /><br>
                <input type="hidden" name="fk_user_id" value= <?php if (isset($memo->fk_user_id)) echo $memo->fk_user_id;?> /><br>
                <textarea type="text" name="memo_content" value=><?php if (isset($memo->memo_content)) echo $memo->memo_content;?></textarea>
                <!-- <input type="text" name="memo_public" value= 
                <?php if (isset($memo->memo_public)) echo $memo->memo_public;?>
                > -->
                <div>
    <input type="radio" id="publicNo" name="memo_public" value=0<?php if (($memo->memo_public)==0) echo "checked";?>>
    <label for="publicNo">privat</label>
    <input type="radio" id="publicYes"
     name="memo_public" value=1<?php if (($memo->memo_public)==1) echo "checked";?>>
    <label for="publicYes">öffentlich</label>
    </div>
            <?php } ?>
            <br><input type="submit" name="submit_update_memo" value="Submit" />
        </form>
    </div>
    </div>
</div>
