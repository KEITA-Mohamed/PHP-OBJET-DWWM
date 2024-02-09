<?PHP

namespace App\Controller;

use App\Service\MyFct;
use App\Model\ClientManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends MyFct{

    public function __construct(){

        $this->writeSheet();
    }

//----------------------Mes Methods-----------------------------

    public function writeSheet(){

        $spreadsheet = IOFactory::load("Public/modele-document/list-des-clients.xlsx");
        $sheet = $spreadsheet->getActiveSheet();

        $cm=new ClientManager();

        $clients=$cm->findAll();

       // $this->printr($clients); die;

        $row=4;
        $nbr=0;

        foreach($clients as $client){

            extract($client);
            $sheet->insertNewRowBefore($row);
            $sheet->setCellValue("A$row", $numClient);
            $sheet->setCellValue("B$row", $nomClient);
            $sheet->setCellValue("C$row", $adresseClient);         
            $row++;
            $nbr++;

        }

        $a3=$sheet->getCell("A3")->getValue();

        if(!$a3){

            $sheet->removeRow(3) ;
        }

       
       // $row = $row-1;
        $sheet->setCellValue("A$row", "Nombre client = $nbr");
        $writer=new Xlsx($spreadsheet);
        $writer->save("list des clients.xlsx");


        echo "exportation terminé!";die;
    }
}