<?php

use Illuminate\Database\Seeder;

use App\Model\FormTemplate;

class FormTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$forms = [

['name' => 'ADA FORM - BDO', 'path' => 'uploads/formtemplates/ADA FORM - BDO.pdf'],
['name' => 'ADA FORM - BPI', 'path' => 'uploads/formtemplates/ADA FORM - BPI.pdf'],
['name' => 'ADA FORM - MBTC', 'path' => 'uploads/formtemplates/ADA FORM - MBTC.pdf'],
['name' => 'AFFIDAVIT OF MARITAL CONSENT', 'path' => 'uploads/formtemplates/AFFIDAVIT OF MARITAL CONSENT.pdf'],
['name' => 'AFFIDAVIT OF MARITAL STATUS', 'path' => 'uploads/formtemplates/AFFIDAVIT OF MARITAL STATUS.pdf'],
['name' => 'SECRETARY CERTIFICATE', 'path' => 'uploads/formtemplates/SECRETARY CERTIFICATE.pdf'],
['name' => 'DOCUMENTARY REQUIREMENTS CHECKLIST', 'path' => 'uploads/formtemplates/DOCUMENTARY REQUIREMENTS CHECKLIST.pdf'],
['name' => 'ADA FORM - PSBANK', 'path' => 'uploads/formtemplates/ADA FORM - PSBANK.pdf'],
['name' => 'AFFIDAVIT OF UNDERTAKING FOR NON-PUBLIC USE', 'path' => 'uploads/formtemplates/AFFIDAVIT OF UNDERTAKING FOR NON-PUBLIC USE.pdf'],
['name' => 'AFFIDAVIT OF UNDERTAKING FOR NON-PUBLIC USE-BLANK', 'path' => 'uploads/formtemplates/AFFIDAVIT OF UNDERTAKING FOR NON-PUBLIC USE-BLANK.pdf'],
['name' => 'OTC BILLS PAYMENT UNDERTAKING', 'path' => 'uploads/formtemplates/OTC BILLS PAYMENT UNDERTAKING.pdf'],
['name' => 'AFFIDAVIT OF ONE AND THE SAME PERSON', 'path' => 'uploads/formtemplates/AFFIDAVIT OF ONE AND THE SAME PERSON.pdf'],
['name' => 'SPECIAL POWER OF ATTORNEY', 'path' => 'uploads/formtemplates/SPECIAL POWER OF ATTORNEY.pdf'],
['name' => 'PARTNERSHIP RESOLUTION', 'path' => 'uploads/formtemplates/PARTNERSHIP RESOLUTION.pdf'],


        ];

        foreach ($forms as $form) {
		    $ftemplateModel = new FormTemplate($form);
		    $ftemplateModel->save();
		}
    }
}
