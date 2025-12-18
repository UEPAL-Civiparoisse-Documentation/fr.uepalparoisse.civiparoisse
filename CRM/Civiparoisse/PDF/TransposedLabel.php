<?php
class CRM_Civiparoisse_PDF_TransposedLabel extends CRM_Utils_PDF_Label
{

  public function AddPdfLabel($texte,$transpose=false) {
    if ($transpose)
    {
      $this->AddTransposedPdfLabel($texte);
    }
    else
    {
      parent::AddPdfLabel($texte);
    }
  }
  /**
   * Transposition (au sens des matrices ) de la fonction parente
   * @param $texte
   * @return void
   */
  public function AddTransposedPdfLabel($texte) {
    if ($this->countY == $this->yNumber) {
      // Page full, we start a new one
      $this->AddPage();
      $this->countX = 0;
      $this->countY = 0;
    }

    $posX = $this->marginLeft + ($this->countX * ($this->width + $this->xSpace));
    $posY = $this->marginTop + ($this->countY * ($this->height + $this->ySpace));
    $this->SetXY($posX + $this->paddingLeft, $posY + $this->paddingTop);
    if ($this->generatorMethod) {
      call_user_func_array([$this->generatorObject, $this->generatorMethod], [$texte]);
    }
    else {
      $this->generateLabel($texte);
    }
    $this->countX++;

    if ($this->countX == $this->xNumber) {
      // End of column reached, we start a new one
      $this->countY++;
      $this->countX = 0;
    }
  }
}
