    <!-- Designchanging Session control -->
    <?php
if ($_SESSION){
    echo "<div class='container'>";
}
else{
    echo"<div>";
}
    ?>
    <h3>öffentliche Memos</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Memo</td>
                <td>Verfasser</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($memos as $memo) { ?>
                <tr>
                    <td><?php if (isset($memo->memo_id)) echo $memo->memo_id; ?></td>
                    <td><?php if (isset($memo->memo_content)) echo $memo->memo_content; ?></td>
                    <td><?php if (isset($memo->fk_user_id)) echo $memo->fk_user_id; ?></td>
                    <td>
                        <?php if (isset($memo->memo_public)) { ?>
                            <a href="<?php echo $memo->memo_public; ?>"><?php echo $memo->link; ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table></div>