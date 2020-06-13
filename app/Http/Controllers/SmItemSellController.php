<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Validator;
use App\SmItem;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmSection;
use App\SmStudent;
use App\SmItemSell;
use App\SmSupplier;
use App\SmItemIssue;
use App\SmItemStore;
use App\ApiBaseMethod;
use App\SmItemCategory;
use App\SmItemSellChild;
use App\SmPaymentMethhod;
use App\SmInventoryPayment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SmItemSellController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }

    public function itemSell(Request $request)
    {
        $suppliers = SmSupplier::where('active_status', '=', 1)->get();
        $items = SmItem::all();
        $roles = Role::all();
        $users = User::all();
        $classes = SmClass::all();
        $paymentMethhods = SmPaymentMethhod::all();

        return view('backEnd.inventory.itemSell', compact('suppliers', 'items', 'paymentMethhods', 'roles', 'users', 'classes'));
    }


    public function getReceiveItem()
    {
        $searchData = SmItem::all();
        if (!empty($searchData)) {
            return json_encode($searchData);
        }
    }


    public function saveItemSellData(Request $request)
    {


        $request->validate([
            'role_id' => "required",
            'sell_date' => "required",
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

        $student_staff_id = '';
        if (!empty($request->student)) {
            $student_staff_id = $request->student;
        }

        if (!empty($request->staff_id)) {
            $student_staff_id = $request->staff_id;
        }

        $itemSells = new SmItemSell();
        $itemSells->role_id = $request->role_id;
        $itemSells->student_staff_id = $student_staff_id;
        $itemSells->reference_no = $request->reference_no;
        $itemSells->sell_date = date('Y-m-d', strtotime($request->sell_date));
        $itemSells->grand_total = $request->subTotalValue;
        $itemSells->total_quantity = $request->subTotalQuantityValue;
        $itemSells->total_paid = $total_paid;
        $itemSells->paid_status = $paid_status;
        $itemSells->total_due = $request->totalDueValue;
        $itemSells->payment_method = $request->payment_method;
        $itemSells->description = $request->description;
        $results = $itemSells->save();
        $itemSells->toArray();

        if ($results) {
            $item_ids = count($request->item_id);
            for ($i = 0; $i < $item_ids; $i++) {
                if (!empty($request->item_id[$i])) {
                    $itemSellChild = new SmItemSellChild();
                    $itemSellChild->item_sell_id = $itemSells->id;
                    $itemSellChild->item_id = $request->item_id[$i];
                    $itemSellChild->sell_price = $request->unit_price[$i];
                    $itemSellChild->quantity = $request->quantity[$i];
                    $itemSellChild->sub_total = $request->totalValue[$i];
                    $itemSellChild->created_by = Auth()->user()->id;
                    $result = $itemSellChild->save();

                    if ($result) {
                        $items = SmItem::find($request->item_id[$i]);
                        $items->total_in_stock = $items->total_in_stock - $request->quantity[$i];
                        $results = $items->update();
                    }
                }
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('item-sell-list');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function checkProductQuantity()
    {
        $product_id = $_POST['product_id'];
        $product_quantity = SmItem::select('total_in_stock')->where('id', $product_id)->first();

        return $product_quantity->total_in_stock;
    }

    public function itemSellList()
    {
        $allItemSellLists = SmItemSell::where('active_status', '=', 1)->get();

        return view('backEnd.inventory.itemSellList', compact('allItemSellLists'));
    }

    public function viewItemSell($id)
    {
        $viewData = SmItemSell::find($id);
        $editDataChildren = SmItemSellChild::where('item_sell_id', $id)->get();
        return view('backEnd.inventory.viewItemSell', compact('viewData', 'editDataChildren'));
    }

    public function editItemSell(Request $request, $id)
    {
        $editData = SmItemSell::find($id);

        $roles = Role::all();

        $studentClassSection = '';
        $staffsByRole = '';
        if ($editData->role_id == 2) {
            $studentClassSection = SmStudent::where('id', $editData->student_staff_id)->first();
            $allStudentsSameClassSection = SmStudent::select('id', 'full_name')->where('class_id', $studentClassSection->class_id)->where('section_id', $studentClassSection->section_id)->get();
        } elseif ($editData->role_id == 3) {
            $staffsByRole = SmParent::where('active_status', 1)->get();
        } else {
            $staffsByRole = SmStaff::where('role_id', $editData->role_id)->get();
        }
        $editDataChildren = SmItemSellChild::where('item_sell_id', $id)->get();
        $users = User::all();
        $items = SmItem::all();
        $classes = SmClass::all();
        $sections = SmSection::all();
        $paymentMethhods = SmPaymentMethhod::all();
        return view('backEnd.inventory.editItemSell', compact('editData', 'editDataChildren', 'roles', 'users', 'items', 'paymentMethhods', 'classes', 'sections', 'studentClassSection', 'allStudentsSameClassSection', 'staffsByRole'));
    }

    public function UpdateItemSellData(Request $request)
    {
        $request->validate([
            'role_id' => "required",
            'sell_date' => "required",
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

        $student_staff_id = '';
        if ($request->role_id == 2) {
            $student_staff_id = $request->student;
        } elseif ($request->role_id != 2) {
            $student_staff_id = $request->staff_id;
        }

        $itemSells = SmItemSell::find($request->id);
        $itemSells->role_id = $request->role_id;
        $itemSells->student_staff_id = $student_staff_id;
        $itemSells->reference_no = $request->reference_no;
        $itemSells->sell_date = date('Y-m-d', strtotime($request->sell_date));
        $itemSells->grand_total = $request->subTotalValue;
        $itemSells->total_quantity = $request->subTotalQuantityValue;
        $itemSells->total_paid = $total_paid;
        $itemSells->paid_status = $paid_status;
        $itemSells->total_due = $request->totalDueValue;
        $itemSells->payment_method = $request->payment_method;
        $itemSells->description = $request->description;
        $results = $itemSells->save();
        $itemSells->toArray();

        if ($results) {
            SmItemSellChild::where('item_sell_id', $itemSells->id)->delete();

            $item_ids = count($request->item_id);
            for ($i = 0; $i < $item_ids; $i++) {
                if (!empty($request->item_id[$i])) {
                    $itemSellChild = new SmItemSellChild();
                    $itemSellChild->item_sell_id = $itemSells->id;
                    $itemSellChild->item_id = $request->item_id[$i];
                    $itemSellChild->sell_price = $request->unit_price[$i];
                    $itemSellChild->quantity = $request->quantity[$i];
                    $itemSellChild->sub_total = $request->totalValue[$i];
                    $itemSellChild->created_by = Auth()->user()->id;
                    $result = $itemSellChild->save();

                    if ($result) {
                        $items = SmItem::find($request->item_id[$i]);
                        $items->total_in_stock = $items->total_in_stock - $request->quantity[$i];
                        $results = $items->update();
                    }
                }
            }
            Toastr::success('Operation successful', 'Success');
            return redirect('item-sell-list');
        } else {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
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

        $itemReceives = SmItemReceive::find($id);
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

    public function itemSellPayment($id)
    {
        $paymentDue = SmItemSell::select('total_due')->where('id', $id)->first();

        $paymentMethhods = SmPaymentMethhod::all();
        return view('backEnd.inventory.itemSellPayment', compact('paymentDue', 'paymentMethhods', 'id'));
    }


    public function saveItemSellPayment(Request $request)
    {

        $payments = new SmInventoryPayment();
        $payments->item_receive_sell_id = $request->item_sell_id;
        $payments->payment_date = date('Y-m-d', strtotime($request->payment_date));
        $payments->reference_no = $request->reference_no;
        $payments->amount = $request->amount;
        $payments->payment_method = $request->payment_method;
        $payments->notes = $request->notes;
        $payments->payment_type = 'S';
        $payments->created_by = Auth()->user()->id;
        $result = $payments->save();

        $itemPaymentDue = SmItemSell::find($request->item_sell_id);
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
        $itemReceives = SmItemSell::find($request->item_sell_id);
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
        $payments = SmInventoryPayment::where('item_receive_id', $id)->where('payment_type', 'R')->get();
        return view('backEnd.inventory.viewReceivePayments', compact('payments', 'id'));
    }

    public function deleteReceivePayment()
    {
        $receive_payment_id = $_POST['receive_payment_id'];
        $paymentHistory = SmInventoryPayment::find($receive_payment_id);
        $item_receive_id = $paymentHistory->item_receive_id;
        $amount = $paymentHistory->amount;

        $itemReceivesData = SmItemReceive::find($item_receive_id);
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
        return view('backEnd.inventory.deleteItemReceiveView', compact('id'));
    }

    public function deleteItemReceive($id)
    {
        $result = SmItemReceive::destroy($id);

        if ($result) {
            $itemReceiveChild = SmItemReceiveChild::where('item_receive_id', $id)->get();
            if (!empty($itemReceiveChild)) {
                foreach ($itemReceiveChild as $value) {
                    $items = SmItem::find($value->item_id);
                    $items->total_in_stock = $items->total_in_stock - $value->quantity;
                    $results = $items->update();
                }
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
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

    // start Item Issue Function
    public function itemIssueList(Request $request)
    {
        $roles = Role::all();
        $classes = SmClass::all();
        $itemCat = SmItemCategory::all();
        $issuedItems = SmItemIssue::where('active_status', '=', 1)->get();

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $data = [];
            $data['roles'] = $roles->toArray();
            $data['classes'] = $classes->toArray();
            $data['itemCat'] = $itemCat->toArray();
            $data['issuedItems'] = $issuedItems->toArray();
            return ApiBaseMethod::sendResponse($data, null);
        }
        return view('backEnd.inventory.issueItemList', compact('issuedItems', 'roles', 'classes', 'itemCat'));
    }

    public function getItemByCategory(Request $request)
    {
        $allitems = SmItem::where('category_name', '=', $request->id)->get();

        $items = [];
        foreach ($allitems as $item) {
            $items[] = SmItem::find($item->id);
        }

        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($items, null);
        }

        return response()->json([$items]);
    }


    public function saveItemIssueData(Request $request)
    {
        $input = $request->all();
        //dd($input);
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            $validator = Validator::make($input, [
                'role_id' => "required",
                'due_date' => "required",
                'item_id' => "required",
                'quantity' => "required",
                'user_id' => "required",
                'staff_id' => "required",

            ]);
        } else {
            $validator = Validator::make($input, [
                'role_id' => "required",
                'due_date' => "required",
                'item_id' => "required",
                'quantity' => "required"
            ]);
        }

        if ($validator->fails()) {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Validation Error.', $validator->errors());
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $issue_to = '';
        if ($request->role_id == 2) {
            if (!empty($request->student)) {
                $issue_to = $request->student;
            } else {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('Please Select a Student for Issue Item.');
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } else {
            if (!empty($request->staff_id)) {
                $issue_to = $request->staff_id;
            } else {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('Please Select a Staff Name for Issue Item.');
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        }

        $user = Auth()->user();

        if ($user) {
            $user_id = $user->id;
        } else {
            $user_id = $request->user_id;
        }

        $itemIssue = new SmItemIssue();
        $itemIssue->role_id = $request->role_id;
        $itemIssue->issue_to = $issue_to;
        $itemIssue->issue_by = $user_id;
        $itemIssue->item_category_id = $request->item_category_id;
        $itemIssue->item_id = $request->item_id;
        $itemIssue->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $itemIssue->due_date = date('Y-m-d', strtotime($request->due_date));
        $itemIssue->quantity = $request->quantity;
        $itemIssue->issue_status = 'I';
        $itemIssue->note = $request->description;
        $results = $itemIssue->save();
        $itemIssue->toArray();

        if ($results) {

            $items = SmItem::find($request->item_id);
            $items->total_in_stock = $items->total_in_stock - $request->quantity;
            $result = $items->update();
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'New Item has been issued successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function returnItemView(Request $request, $id)
    {
        if (ApiBaseMethod::checkUrl($request->fullUrl())) {
            return ApiBaseMethod::sendResponse($id, null);
        }
        return view('backEnd.inventory.returnItemView', compact('id'));
    }

    public function returnItem(Request $request, $id)
    {
        $iuusedItem = SmItemIssue::select('item_id', 'quantity')->where('id', $id)->first();
        $items = SmItem::find($iuusedItem->item_id);
        $items->total_in_stock = $items->total_in_stock + $iuusedItem->quantity;
        $result = $items->update();

        if ($result) {
            $itemissue = SmItemIssue::find($id);
            $itemissue->issue_status = 'R';
            $itemissue->update();

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse(null, 'Item has been returned successfully');
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } else {
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendError('Something went wrong, please try again.');
            }
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function viewSellPayments($id)
    {
        $payments = SmInventoryPayment::where('item_receive_sell_id', $id)->where('payment_type', 'S')->get();

        return view('backEnd.inventory.viewSellPayments', compact('payments', 'id'));
    }

    public function deleteSellPayment()
    {
        $sell_payment_id = $_POST['sell_payment_id'];
        $paymentHistory = SmInventoryPayment::find($sell_payment_id);
        $item_receive_sell_id = $paymentHistory->item_receive_sell_id;
        $amount = $paymentHistory->amount;

        $itemSellData = SmItemSell::find($item_receive_sell_id);
        $itemSellData->total_due = $itemSellData->total_due + $amount;
        $itemSellData->total_paid = $itemSellData->total_paid - $amount;

        // check if total due is greater than 0
        if (($itemSellData->total_due + $amount) > 0) {
            $itemSellData->paid_status = 'PP';
        }

        // check if total due is equal to 0
        if (($itemSellData->total_due + $amount) == 0) {
            $itemSellData->paid_status = 'P';
        }

        $itemSellData->update();

        $result = SmInventoryPayment::destroy($sell_payment_id);
    }

    public function cancelItemSellView($id)
    {
        return view('backEnd.inventory.cancelItemSellView', compact('id'));
    }

    public function cancelItemSell($id)
    {
        $itemSell = SmItemSell::find($id);
        $itemSell->paid_status = 'S';
        $results = $itemSell->update();

        if ($results) {
            $itemSellChild = SmItemSellChild::where('item_sell_id', $id)->get();
            if (!empty($itemSellChild)) {
                foreach ($itemSellChild as $value) {
                    $items = SmItem::find($value->item_id);
                    $items->total_in_stock = $items->total_in_stock + $value->quantity;
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
