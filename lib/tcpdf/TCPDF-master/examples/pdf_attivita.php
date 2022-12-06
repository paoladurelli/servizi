
<?php
require('pdf/fpdf.php');
include_once ('../mysqli_connect.php');
$conn = new mysqli($hostname, $username, $password, $database);
if(!isset($_GET['id'])){
    echo "<script>window.location.href='elenco_attivita.php';</script>";
}else{
    $id = $_GET['id'];
}

function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['V']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter at 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('img/int_centralino.png',9,6,192);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        //$this->Cell(0,10,"Documento riassuntivo di rapporto",1,0,'C');
        // Line break
        $this->Ln(40);
    }

    protected $B;
    protected $I;
    protected $U;
    protected $HREF;
    protected $fontList;
    protected $issetfont;
    protected $issetcolor;

    function __construct($orientation='P', $unit='mm', $format='A4')
    {
        //Call parent constructor
        parent::__construct($orientation,$unit,$format);
        //Initialization
        $this->B=0;
        $this->I=0;
        $this->U=0;
        $this->HREF='';
        $this->fontlist=array('arial', 'times', 'courier', 'helvetica', 'symbol');
        $this->issetfont=false;
        $this->issetcolor=false;
    }

    function WriteHTML($html)
    {
        $html = mb_convert_encoding($html, 'ISO-8859-1', 'UTF-8');
        $html=str_replace("\n",' ',$html); //remplace retour à la ligne par un espace
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //éclate la chaîne avec les balises
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,stripslashes(txtentities($e)));
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract attributes
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $attr=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        //Opening tag
        switch($tag){
            case 'STRONG':
                $this->SetStyle('B',true);
                break;
            case 'EM':
                $this->SetStyle('I',true);
                break;
            case 'B':
            case 'I':
            case 'U':
                $this->SetStyle($tag,true);
                break;
            case 'A':
                $this->HREF=$attr['HREF'];
                break;
            case 'IMG':
                if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                    if(!isset($attr['WIDTH']))
                        $attr['WIDTH'] = 0;
                    if(!isset($attr['HEIGHT']))
                        $attr['HEIGHT'] = 0;
                    $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
                }
                break;
            case 'TR':
            case 'BLOCKQUOTE':
            case 'BR':
                $this->Ln(5);
                break;
            case 'P':
                $this->Ln(10);
                break;
            case 'FONT':
                if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                    $coul=hex2dec($attr['COLOR']);
                    $this->SetTextColor($coul['R'],$coul['V'],$coul['B']);
                    $this->issetcolor=true;
                }
                if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                    $this->SetFont(strtolower($attr['FACE']));
                    $this->issetfont=true;
                }
                break;
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='STRONG')
            $tag='B';
        if($tag=='EM')
            $tag='I';
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='FONT'){
            if ($this->issetcolor==true) {
                $this->SetTextColor(0);
            }
            if ($this->issetfont) {
                $this->SetFont('arial');
                $this->issetfont=false;
            }
        }
    }

    function SetStyle($tag, $enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
        {
            if($this->$s>0)
                $style.=$s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Powered By CRPM+',0,0,'C');
    }

}

function filter_html($value){
    $value = mb_convert_encoding($value, 'ISO-8859-1', 'UTF-8');
    return $value;
}
$result = $conn->query("SELECT * FROM attivita WHERE id='$id'");
$row = $result->fetch_array(MYSQLI_BOTH);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(222,222,222);

$pdf->SetFont('Helvetica','B',10);
if($row[14] != 0){
    $pdf->SetTextColor(244 , 66, 66);
    $ALLERTA = filter_html('                                      IL SEGUENTE DOCUMENTO È DA CONSIDERARSI TEMPORANEO');
    $pdf->Cell(190,7,$ALLERTA,1,1,'L',true);
    $pdf->SetTextColor(0 , 0, 0);
    $pdf->Ln(1);
}

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(90,7,"OPERATORE: $row[2]",1,0,'L',true);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',30);
if($row[3] < '12:00'){
    $pdf->Cell(20,15,"T1",1,0,'C',true);
}else{
    $pdf->Cell(20,15,"T2",1,0,'C',true);
}

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(1);
$GG = filter_html($row[1]);
$pdf->Cell(0,7,"$GG",1,1,'L',true);
$pdf->Ln(1);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(90,7,"Orario di servizio: ore $row[5] - $row[6]",1,0,'L');
$pdf->Cell(22);
$pdf->Cell(0,7,"Apertura ore: $row[3]",1,1,'L');
$pdf->Ln(1);
$g7 = filter_html($row[7]);

$pdf->Cell(0,7,"C.O.: $g7",1,1,'L');
$pdf->Ln(5);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(0,8,"AZIONI SVOLTE",1,1,'C',true);

$result_azioni = $conn->query("SELECT * FROM azioni_attivita WHERE id_assoc = '$id'");
$pdf->SetWidths(array(30,35,60,65));
$pdf->Ln(1);
$pdf->SetFont('Helvetica','',11);
$pdf->Row(array('Ora','Attivita / Telefono','Chiamante','Note'));
while($az_row = $result_azioni->fetch_array(MYSQLI_BOTH)){
    $az1 = filter_html($az_row[1]);
    $az2 = filter_html($az_row[2]);
    $az3 = filter_html($az_row[3]);
    $az4 = filter_html($az_row[4]);
    $pdf->Row(array($az1,$az2,$az3,$az4));

}
$g7 = filter_html($row[7]);
$pdf->Ln(5);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(0,8,"PASSAGGI DI CONSEGNA",1,1,'C',true);
$pdf->SetWidths(array(60,60,70));
$pdf->Ln(1);
$pdf->SetFont('Helvetica','',11);
$pdf->Row(array('Destinatario','Oggetto','Note'));
$pdf->Row(array($row[8],$row[9],$row[10]));
$pdf->Ln(5);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(60,7,"CHIUSURA BROGLIACCIO",1,0,'L',true);
$pdf->SetFillColor(222,222,222);
$pdf->Cell(20,7,"ORA:",1,0,'C',true);
$pdf->Cell(19,7,"$row[11]",1,0,'C');
$pdf->Cell(1);
$pdf->Cell(50,7,"DATA:",1,0,'C',true);
$pdf->Cell(40,7,"FIRMA OPERATORE",1,1,'C',true);
$pdf->Ln(1);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(60,7,"CHIUSURA CENTRALINO",1,0,'L',true);
$pdf->SetFillColor(222,222,222);
$pdf->Cell(20,7,"ORA:",1,0,'C',true);
$pdf->Cell(19,7,"$row[12]",1,0,'C');
$pdf->Cell(1);
$pdf->Cell(50,15,"$GG",1,0,'C');
$pdf->Cell(40,23,"",1,0,'C');
$pdf->Cell(0,7,"",0,1,'C');
$pdf->Ln(1);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(60,7,"",1,0,'L',true);
$pdf->SetFillColor(222,222,222);
$pdf->Cell(20,7,"",1,0,'C',true);
$pdf->Cell(19,7,"",1,0,'C');
$pdf->Cell(1);
$pdf->Cell(50,7,"",0,0,'C');
$pdf->Cell(40,15,"",0,0,'C');
$pdf->Cell(0,7,"",0,1,'C');
$pdf->Ln(1);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(60,7,"",1,0,'L',true);
$pdf->SetFillColor(222,222,222);
$pdf->Cell(20,7,"",1,0,'C',true);
$pdf->Cell(19,7,"",1,0,'C');
$pdf->Cell(1);
$txt = filter_html('ID ATTIVITÀ: ');
$pdf->Cell(50,7,"$txt $row[0]",1,1,'C', true);
$pdf->Ln(1);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(60,7,"PASSAGGIO CONSEGNE",1,0,'L',true);
$pdf->SetFillColor(222,222,222);
$pdf->Cell(20,7,"ORA:",1,0,'C',true);
$pdf->Cell(19,7,"$row[13]",1,0,'C');
$pdf->Cell(1);
$pdf->SetFillColor(192,192,192);
$pdf->Cell(50,7,"PERSONE PRESENTI",1,0,'C',true);
$pdf->Cell(40,7,"",1,1,'C');


$pdf->Output('D',"Centralino_$row[15].pdf",true);
?>