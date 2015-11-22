<?php

namespace App\Http\Controllers\Traits;

use PDF;

trait PdfTrait {

    /**
     * PDF views will have these variables available to them.
     *
     * @return Array
     */
	protected function getPdfOptions() {
		return [];
	}

    /**
     * Force the download of the pdf view
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf() {
        return PDF::loadView(class_basename($this) . '.pdf', $this->getPdfOptions())->download();
    }
}