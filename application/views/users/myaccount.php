<div class="container">
    <!-- personal account data and delete option -->
        <h3>mein Zugang</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Vorname</td>
                <td>Nachname</td>
                <td>Email</td>
                <td>löschen</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($anzlna as $user) { ?>
                <tr>
                    <td><?php if (isset($user->user_fname)) echo $user->user_fname; ?></td>

                    <td><?php if (isset($user->user_lname)) echo $user->user_lname; ?></td>

                    <td><?php if (isset($user->user_email)) echo $user->user_email; ?></td>

                    <td><a href="<?php echo URL . 'users/deleteuser/' . $user->user_id; ?>">lösche meinen Account</a></td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
