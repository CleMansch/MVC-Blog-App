<div class="container">
    <!-- schows all the users; integrated option to user_role upgrade -->
        <h3>Adminpanel</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Vorname</td>
                <td>Nachname</td>
                <td>Email</td>
                <td>machadmin</td>
                <td>löschen</td>
                <td>befördern</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php if (isset($user->user_id)) echo $user->user_id; ?></td>

                    <td><?php if (isset($user->user_fname)) echo $user->user_fname; ?></td>

                    <td><?php if (isset($user->user_lname)) echo $user->user_lname; ?></td>

                    <td><?php if (isset($user->user_email)) echo $user->user_email; ?></td>

                    <td><?php if (isset($user->user_role)) echo $user->user_role; ?></td>

                    <td><a href="<?php echo URL . 'users/deleteuser/' . $user->user_id; ?>">x</a></td>
                    <td><a href="<?php echo URL . 'users/makeAdmin/' . $user->user_id; ?>">x</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
