<?php

namespace App\Http\Controllers;

use App\SmItem;
use App\SmItemSell;
use App\SmSupplier;
use App\SmItemStore;
use App\SmItemReceive;
use App\SmPaymentMethhod;
use App\SmInventoryPayment;
use App\SmItemReceiveChild;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class  SmItemReceiveController extends Controller
{
	public function __construct()
	{
		$this->middleware('PM');
	}

	public function itemReceive()
	{
		$suppliers = SmSupplier::where('active_status', '=', 1)->get();
		$itemStores = SmItemStore::all();
		$items = SmItem::all();
		$paymentMethhods = SmPaymentMethhod::all();
		return view('backEnd.inventory.itemReceive', compact('suppliers', 'itemStores', 'items', 'paymentMethhods'));
	}


	public function getReceiveItem()
	{
		$searchData = SmItem::all();
		if (!empty($searchData)) {
			return json_encode($searchData);
		}
	}


	public function saveItemReceiveData(Request $request)
	{

		$request->validate([
			'supplier_id' => "required",
			'store_id' => "required",

		]);

		$total_paid = '';

		if (empty($request->totalPaidValue)) {
			$total_paid = $request->totalPaid;
		} else {
			$total_paid = $request->totalPaidValue;
		}

		$subTotalValue = round($request->subTotalValue);
		$totalDueValue = round($request->totalDueValue);

		$paid_status = '';
		// if(isset($request->full_paid) && $request->full_paid == '1'){
		// 	$paid_status= 'P';
		// }
		if ($totalDueValue == 0) {
			$paid_status = 'P';
		} elseif ($subTotalValue == $totalDueValue) {
			$paid_status = 'U';
		} else {
			$paid_status = 'PP';
		}

		$itemReceives = new SmItemReceive();
		$itemReceives->supplier_id = $request->supplier_id;
		$itemReceives->store_id = $request->store_id;
		$itemReceives->reference_no = $request->reference_no;
		$itemReceives->receive_date = date('Y-m-d', strtotime($request->receive_date));
		$itemReceives->grand_total = $request->subTotalValue;
		$itemReceives->total_quantity = $request->subTotalQuantityValue;
		$itemReceives->total_paid = $total_paid;
		$itemReceives->paid_status = $paid_status;
		$itemReceives->total_due = $request->totalDueValue;
		$itemReceives->payment_method = $request->payment_method;
		$results = $itemReceives->save();
		$itemReceives->toArray();

		if ($results) {
			$item_ids = count($request->item_id);
			for ($i = 0; $i < $item_ids; $i++) {
				if (!empty($request->item_id[$i])) {
					$itemReceivedChild = new SmItemReceiveChild;
					$itemReceivedChild->item_receive_id = $itemReceives->id;
					$itemReceivedChild->item_id = $request->item_id[$i];
					$itemReceivedChild->unit_price = $request->unit_price[$i];
					$itemReceivedChild->quantity = $request->quantity[$i];
					$itemReceivedChild->sub_total = $request->totalValue[$i];
					$itemReceivedChild->created_by = Auth()->user()->id;
					$result = $itemReceivedChild->save();

					if ($result) {
						$items = SmItem::find($request->item_id[$i]);
						$items->total_in_stock = $items->total_in_stock + $request->quantity[$i];
						$results = $items->update();
					}
				}
			}
			Toastr::success('Operation successful', 'Success');
			return redirect('item-receive-list');
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	public function itemReceiveList()
	{

		$allItemReceiveLists = SmItemReceive::where('active_status', '=', 1)->get();
		return view('backEnd.inventory.itemReceiveList', compact('allItemReceiveLists'));
	}


	public function editItemReceive(Request $request, $id)
	{
		$editData = SmItemReceive::find($id);
		$editDataChildren = SmItemReceiveChild::where('item_receive_id', $id)->get();
		$suppliers = SmSupplier::where('active_status', '=', 1)->get();
		$itemStores = SmItemStore::all();
		$items = SmItem::all();
		$paymentMethhods = SmPaymentMethhod::all();
		return view('backEnd.inventory.editItemReceive', compact('editData', 'editDataChildren', 'suppliers', 'itemStores', 'items', 'paymentMethhods'));
	}

	public function updateItemReceiveData(Request $request, $id)
	{
		$request->validate([
			'supplier_id' => "required",
			'store_id' => "required",

		]);

		$total_paid = '';

		if (empty($request->totalPaidValue)) {
			$total_paid = $request->totalPaid;
		} else {
			$total_paid = $request->totalPaidValue;
		}

		$subTotalValue = round($request->subTotalValue);
		$totalDueValue = round($request->totalDueValue);

		$paid_status = '';
		if ($totalDueValue == 0) {
			$paid_status = 'P';
		} elseif ($subTotalValue == $totalDueValue) {
			$paid_status = 'U';
		} else {
			$paid_status = 'PP';
		}

		$itemReceives =  SmItemReceive::find($id);
		$itemReceives->supplier_id = $request->supplier_id;
		$itemReceives->store_id = $request->store_id;
		$itemReceives->reference_no = $request->reference_no;
		$itemReceives->receive_date = date('Y-m-d', strtotime($request->receive_date));
		$itemReceives->grand_total = $request->subTotalValue;
		$itemReceives->total_quantity = $request->subTotalQuantityValue;
		$itemReceives->total_paid = $total_paid;
		$itemReceives->paid_status = $paid_status;
		$itemReceives->total_due = $request->totalDueValue;
		$itemReceives->payment_method = $request->payment_method;
		$results = $itemReceives->update();

		if ($results) {
			$allItemReceiveChildren = SmItemReceiveChild::where('item_receive_id', $id)->get();
			foreach ($allItemReceiveChildren as $value) {
				$items = SmItem::find($value->item_id);
				$items->total_in_stock = $items->total_in_stock - $value->quantity;
				$results = $items->update();
			}
		}

		$itemReceiveChildren = SmItemReceiveChild::where('item_receive_id', $id)->delete();


		if ($itemReceiveChildren) {
			$item_ids = count($request->item_id);
			for ($i = 0; $i < $item_ids; $i++) {
				if (!empty($request->item_id[$i])) {
					$itemReceivedChild = new SmItemReceiveChild;
					$itemReceivedChild->item_receive_id = $id;
					$itemReceivedChild->item_id = $request->item_id[$i];
					$itemReceivedChild->unit_price = $request->unit_price[$i];
					$itemReceivedChild->quantity = $request->quantity[$i];
					$itemReceivedChild->sub_total = $request->totalValue[$i];
					$itemReceivedChild->created_by = Auth()->user()->id;
					$result = $itemReceivedChild->save();

					if ($result) {
						$items = SmItem::find($request->item_id[$i]);
						$items->total_in_stock = $items->total_in_stock + $request->quantity[$i];
						$results = $items->update();
					}
				}
			}
			Toastr::success('Operation successful', 'Success');
			return redirect('item-receive-list');
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	public function viewItemReceive($id)
	{

		$viewData = SmItemReceive::find($id);
		$editDataChildren = SmItemReceiveChild::where('item_receive_id', $id)->get();
		return view('backEnd.inventory.viewItemReceive', compact('viewData', 'editDataChildren'));
	}

	public function itemReceivePayment($id)
	{
		$paymentDue = SmItemReceive::select('total_due')->where('id', $id)->first();
		$paymentMethhods = SmPaymentMethhod::all();
		return view('backEnd.inventory.itemReceivePayment', compact('paymentDue', 'paymentMethhods', 'id'));
	}


	public function saveItemReceivePayment(Request $request)
	{

		$payments = new SmInventoryPayment();
		$payments->item_receive_sell_id = $request->item_receive_id;
		$payments->payment_date = date('Y-m-d', strtotime($request->payment_date));
		$payments->reference_no = $request->reference_no;
		$payments->amount = $request->amount;
		$payments->payment_method = $request->payment_method;
		$payments->notes = $request->notes;
		$payments->payment_type = 'R';
		$payments->created_by = Auth()->user()->id;
		$result = $payments->save();

		$itemPaymentDue = SmItemReceive::find($request->item_receive_id);
		if (isset($itemPaymentDue)) {
			$total_due = $itemPaymentDue->total_due;
			$total_paid = $itemPaymentDue->total_paid;
			$updated_total_due = $total_due - $request->amount;
			$updated_total_paid = $total_paid + $request->amount;

			//$itemReceives = new SmItemReceive();
			$itemPaymentDue->total_due = $updated_total_due;
			$itemPaymentDue->total_paid = $updated_total_paid;
			$result = $itemPaymentDue->update();
		}

		// check if full paid
		$itemReceives = SmItemReceive::find($request->item_receive_id);
		if ($itemReceives->total_due == 0) {
			$itemReceives->paid_status = 'P';
		}

		// check if Partial paid
		if ($itemReceives->grand_total > $itemReceives->total_due && $itemReceives->total_due > 0) {
			$itemReceives->paid_status = 'PP';
		}

		$results = $itemReceives->update();


		if ($result) {
			Toastr::success('Operation successful', 'Success');
			return redirect()->back();
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	public function viewReceivePayments($id)
	{
		$payments = SmInventoryPayment::where('item_receive_sell_id', $id)->where('payment_type', 'R')->get();

		return view('backEnd.inventory.viewReceivePayments', compact('payments', 'id'));
	}

	public function deleteReceivePayment()
	{
		$receive_payment_id = $_POST['receive_payment_id'];
		$paymentHistory = SmInventoryPayment::find($receive_payment_id);
		$item_receive_sell_id = $paymentHistory->item_receive_sell_id;
		$amount = $paymentHistory->amount;

		$itemReceivesData = SmItemReceive::find($item_receive_sell_id);
		$itemReceivesData->total_due = $itemReceivesData->total_due + $amount;
		$itemReceivesData->total_paid = $itemReceivesData->total_paid - $amount;

		// check if total due is greater than 0
		if (($itemReceivesData->total_due + $amount) > 0) {
			$itemReceivesData->paid_status = 'PP';
		}

		// check if total due is equal to 0
		if (($itemReceivesData->total_due + $amount) == 0) {
			$itemReceivesData->paid_status = 'P';
		}

		$itemReceivesData->update();

		$result = SmInventoryPayment::destroy($receive_payment_id);
	}

	public function deleteItemReceiveView($id)
	{

		$title = "Are you sure to detete this Receive item?";
		$url = url('delete-item-receive/' . $id);
		return view('backEnd.modal.delete', compact('id', 'title', 'url'));
	}
	public function deleteItemSaleView($id)
	{

		$title = "Are you sure to detete this Sale item?";
		$url = url('delete-item-sale/' . $id);
		return view('backEnd.modal.delete', compact('id', 'title', 'url'));
	}

	public function deleteItemReceive($id)
	{

		$tables = \App\tableList::getTableList('item_receive_id');
		try {
			$result = SmItemReceive::destroy($id);
			if ($result) {
				Toastr::success('Operation successful', 'Success');
				return redirect()->back();
			} else {
				Toastr::error('Operation Failed', 'Failed');
				return redirect()->back();
			}
		} catch (\Illuminate\Database\QueryException $e) {

			$msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
			return redirect()->back()->with('message-danger', $msg);
		} catch (\Exception $e) {
			//dd($e->getMessage(), $e->errorInfo);
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}
	public function deleteItemSale($id)
	{

		$tables = \App\tableList::getTableList('item_sell_id');
		//return $tables;
		try {
			$result = SmItemSell::destroy($id);
			return $result;
			if ($result) {
				Toastr::success('Operation successful', 'Success');
				return redirect()->back();
			} else {
				Toastr::error('Operation Failed', 'Failed');
				return redirect()->back();
			}
		} catch (\Illuminate\Database\QueryException $e) {

			$msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
			return redirect()->back()->with('message-danger', $msg);
		} catch (\Exception $e) {
			//dd($e->getMessage(), $e->errorInfo);
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}

	public function cancelItemReceiveView($id)
	{
		return view('backEnd.inventory.cancelItemReceiveView', compact('id'));
	}

	public function cancelItemReceive($id)
	{
		$itemReceives = SmItemReceive::find($id);
		$itemReceives->paid_status = 'R';
		$results = $itemReceives->update();

		if ($results) {
			$itemReceiveChild = SmItemReceiveChild::where('item_receive_id', $id)->get();
			if (!empty($itemReceiveChild)) {
				foreach ($itemReceiveChild as $value) {
					$items = SmItem::find($value->item_id);
					$items->total_in_stock = $items->total_in_stock - $value->quantity;
					$result = $items->update();
				}
			}
			Toastr::success('Operation successful', 'Success');
			return redirect()->back();
		} else {
			Toastr::error('Operation Failed', 'Failed');
			return redirect()->back();
		}
	}
}
