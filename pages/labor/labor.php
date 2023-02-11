<div class="table-container">
<table id="tabeldata" class="table table-striped display tabel-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pemeriksaan</th>
            <th scope="col">Satuan</th>
            <th scope="col">Nilai Normal</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga Tindakan</th>
            <th scope="col">tgl input</th>
        </tr>
    </thead>
    <tbody>
        <?php
          include('koneksi.php');
            $no=1;
            $query=mysqli_query($conn, "SELECT * FROM data_labor");
            while ($result=mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $result['nm_labor']; ?>
                        </td>
                        <td>
                            <?php echo $result['satuan']; ?>
                        </td>
                        <td>
                            <?php echo $result['nilai_normal']; ?>
                        </td>
                    <td>
                            <?php echo $result['kategori']; ?>
                        </td>
                        <td>
                            <?php echo $result['harga_labor']; ?>
                        </td>
                        <td>
                            <?php echo $result['tgl_input']; ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>