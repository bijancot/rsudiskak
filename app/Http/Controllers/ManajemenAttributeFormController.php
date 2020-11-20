<?php

namespace App\Http\Controllers;

use App\AttributeForm;
use App\DetailAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ManajemenAttributeFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeForm = AttributeForm::where("deleted_at", Null)->get();
        return view('pages.admin.manajemen_form.m_attributeForm', compact('attributeForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttribute(Request $request)
    {
        $request->validate([
            'namaAttribute'     => 'required|max:255',
            'namaCollection'    => 'required|max:255',
        ]);

        $getHuruf       = $request->namaCollection;
        $hurufAwal      = substr($request->namaCollection, 0, 1);
        $hurufAwalK     = strtolower($hurufAwal);
        $hurufKedua     = substr($request->namaCollection, 1, strlen($getHuruf));
        // $namaCollect    = str_replace($hurufAwal, $hurufAwalK, $getHuruf);
        $namaCollect    = $hurufAwalK . $hurufKedua;

        AttributeForm::create([
            'namaAttribute'     => $request->namaAttribute,
            'namaCollection'    => $namaCollect,
            'updated_at'        => NULL,
            'deleted_at'        => NULL,
        ]);

        return redirect('m_attribute');
    }

    public function storeDetailAttribute(Request $request, AttributeForm $attributeForm)
    {
        $request->validate([
            'namaAttribute'     => 'required|max:255',
        ]);

        DB::collection($attributeForm->namaCollection)->insert([
            $attributeForm->namaAttribute => $request->get('namaAttribute'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
            'deleted_at' => NULL,
        ]);

        return redirect('m_attribute/' . $attributeForm->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeForm  $attributeForm
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeForm $attributeForm)
    {
        // return view('pages.admin.manajemen_form.m_showAttribute', ['user' => AttributeForm::findOrFail($attributeForm->id)]);

        $detailAttribute = new DetailAttribute();
        $detailAttribute->collection    = $attributeForm->namaCollection;
        $getDetailAttribute             = $detailAttribute->where('deleted_at', null)->get();

        $data = [
            'showAttributeForm'     => $getDetailAttribute,
            'attributeForm'         => $attributeForm,
        ];
        return view('pages.admin.manajemen_form.m_showAttribute', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeForm  $attributeForm
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeForm $attributeForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeForm  $attributeForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeForm $attributeForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeForm  $attributeForm
     * @return \Illuminate\Http\Response
     */
    public function destroyAttribute(AttributeForm $attributeForm)
    {
        // SoftDelete
        AttributeForm::where('_id', $attributeForm->id)
            ->update([
                'deleted_at' => date("Y-m-d h:i:s"),
            ]);

        // NormalDelete
        // Agama::destroy($agama->id);
        return redirect('m_attribute');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeForm  $attributeForm
     * @param  \App\DetailAttribute  $detailAtribute
     * @return \Illuminate\Http\Response
     */
    public function destroyDetailAttribute(Request $request, AttributeForm $attributeForm, DetailAttribute $detailAttribute)
    {
        // SoftDelete
        // AttributeForm::where('_id', $attributeForm->id)
        //     ->update([
        //         'deleted_at' => date("Y-m-d h:i:s"),
        //     ]);

        // NormalDelete
        DB::collection($attributeForm->namaCollection)->where('_id', $request->get('id_detail'))->delete();
        return redirect('m_attribute/' . $attributeForm->id);
    }
}
