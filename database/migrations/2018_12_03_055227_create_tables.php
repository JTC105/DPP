<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('dealer_infos')) {
            Schema::create('dealer_infos', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('party_id')->unsigned()->default(0);
                $table->integer('party_no')->unsigned()->default(0);
                $table->string('dealer_name')->nullable();
                $table->string('reference')->nullable();
                $table->string('address')->nullable();
                $table->string('dealer_tin')->nullable();

                $table->string('signatory1')->nullable();
                $table->string('signatory1_tin')->nullable();
                $table->string('signatory1_govtid')->nullable();
                $table->string('signatory2')->nullable();
                $table->string('signatory2_tin')->nullable();
                $table->string('signatory2_govtid')->nullable();

                $table->boolean('is_metro')->default(true);

                $table->boolean('is_2party')->default(true);
                $table->boolean('is_3party')->default(true);
                $table->boolean('is_active')->default(true);
                $table->boolean('is_locked')->default(false);
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->rememberToken();

                $table->string('username');
                $table->string('password');
                $table->datetime('last_changepass_date')->nullable(); 
                $table->boolean('is_active')->default(true);
                $table->boolean('is_ftul')->default(true); // First time user login
                $table->integer('dealer_party_id')->unsigned()->nullable();
                $table->integer('is_admin_level')->default(0); //used in determining admin level... 0 - Dealer, 1 - Super admin, 2 - Level 2 User, 3 - Level 3 User (NOT SURE IF NEEDED)
                $table->integer('creator_id')->default(0); // used in determining the ID of the account creator... 0 - Dealer | Super admin, Other number - User ID (NOT SURE IF NEEDED)

                 $table->boolean('is_locked')->default(false);
                 $table->integer('failed_attempt_count')->default(0);
                 $table->datetime('last_fattempt_date')->nullable();           
            });
        }

        if (!Schema::hasTable('tfsph_signatory_details')) {
            Schema::create('tfsph_signatory_details', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->nullable();
                $table->string('tin_id')->nullable();
                $table->string('govt_id')->nullable();
                $table->string('position')->nullable();
                $table->boolean('is_active')->default(true);
            });
        }

        if (!Schema::hasTable('tfsph_signatories')) {
            Schema::create('tfsph_signatories', function (Blueprint $table) {
                $table->integer('dealer_info_party_id')->unsigned()->nullable();
                $table->integer('signatory1_id')->unsigned()->nullable();
                $table->integer('signatory2_id')->unsigned()->nullable();
                 $table->timestamps();

                // $table->foreign('dealer_info_party_id')->references('party_id')->on('dealer_infos');
                $table->foreign('signatory1_id')->references('id')->on('tfsph_signatory_details');
                $table->foreign('signatory2_id')->references('id')->on('tfsph_signatory_details');
            });
        }

        if (!Schema::hasTable('form_templates')) {
            Schema::create('form_templates', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->nullable();
                // $table->string('desc')->nullable();
                $table->string('path')->nullable();
                $table->char('size')->nullable();
            });
        }

        if (!Schema::hasTable('vehicles')) {
            Schema::create('vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->nullable();
            });
        }

        if (!Schema::hasTable('custom_fields_refs')) {
            schema::create('custom_fields_refs', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('desc_id')->nullable();
                $table->string('desc')->nullable();
            });
        }

        if (!Schema::hasTable('custom_fields')) {
            Schema::create('custom_fields', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('desc_id')->nullable();
                $table->integer('field_id')->nullable();
                $table->string('field_name')->nullable();
                $table->string('field_value')->nullable();
            });
        }

        if (!Schema::hasTable('city_muns')) {
            Schema::create('city_muns', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->nullable();
            });
        }

        if (!Schema::hasTable('outoftowns')) {
            Schema::create('outoftowns', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('province')->nullable();
                $table->integer('annotation')->unsigned()->nullable();
                $table->integer('encumbrance')->unsigned()->nullable();
                $table->integer('total')->unsigned()->nullable();
            });
        }

        if (!Schema::hasTable('fees_customs')) {
            Schema::create('fees_customs', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('dealer_party_id')->unsigned()->nullable();
                $table->string('fees_2party')->nullable();
                $table->string('fees_3party')->nullable();
                $table->string('fees_lease')->nullable();
            });
        }

        if (!Schema::hasTable('pncmfees_dealer_ref')) {
            Schema::create('pncmfees_dealer_ref', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('dealer_party_id')->unsigned()->nullable();
                $table->string('table_no')->nullable();
            });
        }

        if (!Schema::hasTable('pncmfees_retailtable1')) {
            Schema::create('pncmfees_retailtable1', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('party_type')->unsigned()->nullable();
                $table->string('rate')->nullable();
                $table->string('amt_threshold_from')->nullable();
                $table->string('amt_threshold_to')->nullable();
            });
        }

        if (!Schema::hasTable('pncmfees_retailtable2')) {
            Schema::create('pncmfees_retailtable2', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('party_type')->unsigned()->nullable();
                $table->string('rate')->nullable();
                $table->string('amt_threshold_from')->nullable();
                $table->string('amt_threshold_to')->nullable();
            });
        }

        if (!Schema::hasTable('pncmfees_retailtable3')) {
            Schema::create('pncmfees_retailtable3', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->integer('party_type')->unsigned()->nullable();
                $table->string('rate')->nullable();
                $table->string('amt_threshold_from')->nullable();
                $table->string('amt_threshold_to')->nullable();
            });
        }

        if (!Schema::hasTable('regfee_twoparty')) {
            Schema::create('regfee_twoparty', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('range1')->nullable();
                $table->string('range2')->nullable();
                $table->string('dst')->nullable();
                $table->string('notarial')->nullable();
                $table->string('rd')->nullable();
                $table->string('encumbrance')->nullable();
                $table->string('rcm')->nullable();
                $table->string('cifee')->nullable();
                $table->string('sc')->nullable();
                $table->string('total')->nullable();

            });
        }

        if (!Schema::hasTable('regfee_threeparty')) {
            Schema::create('regfee_threeparty', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('range1')->nullable();
                $table->string('range2')->nullable();
                $table->string('dst')->nullable();
                $table->string('rd')->nullable();
                $table->string('encumbrance')->nullable();
                $table->string('rcm')->nullable();
                $table->string('cifee')->nullable();
                $table->string('sc')->nullable();
                $table->string('total')->nullable();

            });
        }

        //  Schema::create('pncm_cmrates', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->timestamps();

        //     $table->integer('orderby')->nullable();
        //     $table->decimal('rate')->nullable();
        //     $table->decimal('amt_threshold_from')->nullable();
        //     $table->decimal('amt_threshold_to')->nullable();
        //     $table->string('fee_name')->nullable();
        // });

        if (!Schema::hasTable('contracts')) {
            Schema::create('contracts', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                //contract details
                $table->biginteger('contract_id')->nullable();
                $table->integer('product_type')->nullable();
                $table->integer('retail_type')->nullable();
                $table->boolean('is_fleet')->default(false);
                $table->datetime('dateaccepted')->nullable();
                $table->datetime('firstduedate')->nullable();
                $table->string('custom_reqs', 4000)->nullable(); 
                $table->string('conreqs_ids')->nullable();
                $table->boolean('is_conreqs_upload')->default(false);

                // additional for report
                $table->string('status')->nullable();
                $table->datetime('credit_approval_date')->nullable();
                $table->datetime('credit_approval_validity')->nullable();
                $table->datetime('credit_approval_recon_date')->nullable();
                $table->datetime('recon_date')->nullable();

                //client details
                $table->integer('party_type')->nullable();
                $table->string('client_name')->nullable();
                $table->string('client_marital')->nullable();
                $table->string('client_govid')->nullable();
                $table->string('client_tin')->nullable();
                $table->datetime('client_dateissued')->nullable();
                $table->string('client_nationality')->nullable();
                $table->string('client_address', 4000)->nullable();
                $table->string('client_city_mun')->nullable(); //city municipality
                $table->string('client_city_mun_others')->nullable(); // city municipality that are not in the list

                //co maker details
                $table->string('comaker_name')->nullable();
                $table->string('comaker_marital')->nullable();
                $table->string('comaker_govid')->nullable();
                $table->string('comaker_tin')->nullable();
                $table->datetime('comaker_dateissued')->nullable();

                //witness details
                $table->string('witness1_name')->nullable();
                $table->string('witness1_tin')->nullable();
                $table->string('witness2_name')->nullable();
                $table->string('witness2_tin')->nullable();

                //dealer details
                $table->integer('dealer_id')->nullable(); // party id?
                $table->string('dealer_signatory')->nullable();
                $table->string('dealer_signatory_tin')->nullable();
                $table->string('dealer_signatory_govid')->nullable();

                //vehicle details
                $table->string('vehicle_name')->nullable();
                $table->string('vehicle_color')->nullable();
                $table->string('vehicle_engine')->nullable();
                $table->string('vehicle_chasis')->nullable();
                $table->string('vehicle_make')->nullable();
                $table->string('vehicle_yearmodel')->nullable();
                $table->string('vehicle_consticker')->nullable(); //conduction sticker
                $table->string('vehicle_usage')->nullable();
                $table->string('invoice_no')->nullable();

                // insurance details
                $table->string('insurer')->nullable();
                $table->string('insurance_period')->nullable();
                $table->string('insurance_liability')->nullable();
                $table->datetime('insurance_effective_date')->nullable();
                $table->datetime('insurance_expiry_date')->nullable();
                $table->string('insurance_comment', 255)->nullable();

                //finance details
                $table->integer('term')->nullable();
                $table->string('add_on_rate')->nullable(); //add on rate
                $table->string('unit_cost')->nullable();
                $table->string('downpayment')->nullable(); //downpayment
                $table->string('amount_finance')->nullable(); //amount financed
                $table->string('monthly_installment')->nullable(); //monthly installments
                $table->boolean('is_outoftown')->default(false);
                $table->string('province')->nullable();
                $table->string('outoftown_charge')->nullable();
                $table->string('dst')->nullable();
                $table->string('leaseretail_fee')->nullable(); //lease,retail fee
                $table->string('total_fees')->nullable();
                $table->string('other_charges')->nullable();
                $table->string('balloon')->nullable();

                $table->boolean('is_onemonthadvance')->default(false); //one month adv.
                $table->boolean('is_cicharge')->default(false);

                $table->datetime('dateprinted')->nullable();
            });
        }

        if (!Schema::hasTable('contracts_histories')) {
            Schema::create('contracts_histories', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                //contract details
                $table->biginteger('contract_id')->nullable();
                $table->integer('revision_number')->nullable();
                $table->datetime('revisiondate')->nullable();
                $table->string('revisor_username')->nullable();

                $table->integer('product_type')->nullable();
                $table->integer('retail_type')->nullable();
                $table->boolean('is_fleet')->default(false);
                $table->datetime('dateaccepted')->nullable();
                $table->datetime('firstduedate')->nullable();
                $table->string('custom_reqs', 4000)->nullable(); // 
                $table->string('conreqs_ids')->nullable(); //
                $table->boolean('is_conreqs_upload')->default(false); //

                // additional for report
                $table->string('status')->nullable();
                $table->datetime('credit_approval_date')->nullable();
                $table->datetime('credit_approval_validity')->nullable();
                $table->datetime('credit_approval_recon_date')->nullable();
                $table->datetime('recon_date')->nullable();

                //client details
                $table->integer('party_type')->nullable();
                $table->string('client_name')->nullable();
                $table->string('client_marital')->nullable();
                $table->string('client_govid')->nullable();
                $table->string('client_tin')->nullable();
                $table->datetime('client_dateissued')->nullable();
                $table->string('client_nationality')->nullable();
                $table->string('client_address', 4000)->nullable();
                $table->string('client_city_mun')->nullable(); //city municipality

                //co maker details
                $table->string('comaker_name')->nullable();
                $table->string('comaker_marital')->nullable();
                $table->string('comaker_govid')->nullable();
                $table->string('comaker_tin')->nullable();
                $table->datetime('comaker_dateissued')->nullable();

                //witness details
                $table->string('witness1_name')->nullable();
                $table->string('witness1_tin')->nullable();
                $table->string('witness2_name')->nullable();
                $table->string('witness2_tin')->nullable();

                //dealer details
                $table->integer('dealer_id')->nullable(); // party id?
                $table->string('dealer_signatory')->nullable();
                $table->string('dealer_signatory_tin')->nullable();
                $table->string('dealer_signatory_govid')->nullable();

                //vehicle details
                $table->string('vehicle_name')->nullable();
                $table->string('vehicle_color')->nullable();
                $table->string('vehicle_engine')->nullable();
                $table->string('vehicle_chasis')->nullable();
                $table->string('vehicle_make')->nullable();
                $table->string('vehicle_yearmodel')->nullable();
                $table->string('vehicle_consticker')->nullable(); //conduction sticker
                $table->string('vehicle_usage')->nullable();
                $table->string('invoice_no')->nullable();

                // insurance details
                $table->string('insurer')->nullable();
                $table->string('insurance_period')->nullable();
                $table->string('insurance_liability')->nullable();
                $table->datetime('insurance_effective_date')->nullable();
                $table->datetime('insurance_expiry_date')->nullable();
                $table->string('insurance_comment', 255)->nullable();

                //finance details
                $table->integer('term')->nullable();
                $table->string('add_on_rate')->nullable(); //add on rate
                $table->string('unit_cost')->nullable();
                $table->string('downpayment')->nullable(); //downpayment
                $table->string('amount_finance')->nullable(); //amount financed
                $table->string('monthly_installment')->nullable(); //monthly installments
                $table->boolean('is_outoftown')->default(false);
                $table->string('province')->nullable();
                $table->string('outoftown_charge')->nullable();
                $table->string('dst')->nullable();
                $table->string('leaseretail_fee')->nullable(); //lease,retail fee
                $table->string('total_fees')->nullable();
                $table->string('other_charges')->nullable();
                $table->string('balloon')->nullable();

                $table->boolean('is_onemonthadvance')->default(false); //one month adv.
                $table->boolean('is_cicharge')->default(false);

                $table->datetime('dateprinted')->nullable();
            });
        }

         if (!Schema::hasTable('contract_requirement_logs')) {
            Schema::create('contract_requirement_logs', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->datetime('dateupload')->nullable();
                $table->integer('contract_id')->nullable();
                $table->string('notes')->nullable();
                $table->string('username')->nullable();
            });
        }

        if (!Schema::hasTable('policies')) {
            Schema::create('policies', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->nullable();
                $table->string('display_name')->nullable();
                $table->string('desc')->nullable();
                $table->string('value')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        // Schema::dropIfExists('dealer_infos');
        // Schema::dropIfExists('users');
        // Schema::dropIfExists('tfsph_signatory_details');
        // Schema::dropIfExists('tfsph_signatories');
        // Schema::dropIfExists('form_templates');
        // Schema::dropIfExists('vehicles');
    }
}
