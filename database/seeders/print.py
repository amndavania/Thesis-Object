grup = [
    "grup akun pendapatan",
    "grup akun pengeluaran",
    "grup akun penyusutan/amortisasi",
    "grup akun bunga/pajak",
    "grup akun pendapatan atau pengeluaran lain2",
    "grup akun aktiva lancar",
    "grup akun aktiva tetap",
    "grup akun hutang lancar",
    "grup akun utang jangka panjang",
    "grup akun modal",
    "grup akun kas masuk",
    "grup akun kas keluar",
    "grup akun penjualan aset",
    "grup akun pembelian aset",
    "grup akun penambahan dana",
    "grup akun pengurangan dana",
    "grup akun modal di awal",
    "grup akun penambahan modal",
    "grup akun pengurangan modal",
]

for i in range(len(grup)):
    print(
        "AccountingGroup::factory()->create(['name'=> '"
        + grup[i]
        + "','description' => '"
        + grup[i]
        + "']);"
    )
