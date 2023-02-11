<div class="table-container">
<table id="tabeldata" class="table table-striped display tabel-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Aturan Pakai</th>
        </tr>
    </thead>
    <tbody>
        <?php
          include('koneksi.php');
            $no=1;
            $query=mysqli_query($conn, "SELECT * FROM tbl_akai");
            while ($result=mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $result['aturan_pakai']; ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>