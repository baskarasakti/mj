<!-- Sample data to populate jsGrid demo tables -->
    <script src="<?= base_url() ?>assets/data/js/jsgrid-db.js"></script>

    <script>
      app.ready(function(){


        /*
        |--------------------------------------------------------------------------
        | jsGrid - Getting started
        |--------------------------------------------------------------------------
        */
        var clients = [
            { "Kode Item": "Test", "Qty": 25, "Harga": 50000},
        ];

        $("#jsgrid-start").jsGrid({
            width: "100%",
            height: "314px",

            inserting: true,
            editing: true,
            sorting: true,
            paging: true,

            // data: clients,

            fields: [
                { name: "Kode Item", type: "text", width: 150, validate: "required" },
                { name: "Qty", type: "number", width: 50 },
                { name: "Harga Satuan", type: "text", width: 200 },
                { type: "control" }
            ]
        });

      });
    </script>