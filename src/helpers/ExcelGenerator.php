<?php
namespace Pipeg\Suplos\helpers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelGenerator{

    protected Spreadsheet $spreadsheet;
    protected Worksheet $sheet;
    public string $nameFile;

    public function __construct($nameFile){
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
        $this->nameFile = $nameFile;
    }

    
    public function setHeaders(array $headers){
        $this->sheet->fromArray($headers, null); // Por default A1
        return $this;
    }

    public function writeInfoFromArray(array $array){
        $this->sheet->fromArray($array, null, "A2"); // A1 son headers, B2 info
        return $this;
    }

    public function saveFile(){
        $route = "src/public/" . $this->nameFile . ".xlsx";
        $writer = new Xlsx($this->spreadsheet);
            // Intenta guardar el archivo
        try {
            $writer->save($route);
            // Si se guardó correctamente, devuelve la ruta del archivo y un mensaje de éxito
            return [
                "success" => true,
                "message" => "File created successfully",
                "route" => $route 
            ];
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            // Si hubo un error al guardar, devuelve un mensaje de error
            return [
                "success" => false,
                "message" => "Error al crear el archivo: " . $e->getMessage()
            ];
        }
    }

    

}