<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $createInvoice = new Permission();
        $createInvoice->name = 'create-invoice';
        $createInvoice->display_name = 'Create Invoices'; // optional
        // Allow a user to...
        $createInvoice->description = 'create new invoices'; // optional
        $createInvoice->save();

        $editInvoice = new Permission();
        $editInvoice->name = 'edit-invoice';
        $editInvoice->display_name = 'Edit Invoices'; // optional
        // Allow a user to...
        $editInvoice->description = 'edit new invoices'; // optional
        $editInvoice->save();

        $deleteInvoice = new Permission();
        $deleteInvoice->name = 'delete-invoice';
        $deleteInvoice->display_name = 'Delete Invoices'; // optional
        // Allow a user to...
        $deleteInvoice->description = 'delete new invoices'; // optional
        $deleteInvoice->save();
    }
}
