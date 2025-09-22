<?php

namespace App\Livewire\Sales;

use App\Models\GroupInventories\GroupInventory;
use App\Models\GroupInventories\GroupInventoryDetails;
use Livewire\Attributes\On;
use Livewire\Component;

class GroupsSelector extends Component
{
    public $selectedGroupInventoryVariable;
    public $groupsInventories = [];
    public $selectedGroups = []; // Array to store multiple selected groups
    public $quantities = []; // Changed to plural for clarity
    
    public function mount()
    {
        $this->groupsInventories = GroupInventory::where('valid', true)->get();
    }

    public function addGroupToSelection()
    {
        if (!$this->selectedGroupInventoryVariable) {
            session()->flash('error', 'يرجى اختيار عرض أولاً');
            return;
        }

        // Check if group is already added
        if (isset($this->selectedGroups[$this->selectedGroupInventoryVariable])) {
            session()->flash('error', 'تم إضافة هذا العرض بالفعل');
            return;
        }

        $group = $this->groupsInventories->where('id', $this->selectedGroupInventoryVariable)->first();
        
        if ($group) {
            $this->selectedGroups[$this->selectedGroupInventoryVariable] = [
                'id' => $group->id,
                'name' => $group->name,
                'price' => $group->price,
                'details' => GroupInventoryDetails::where('group_id', $group->id)->get(),
                'quantity' => 1 // Default quantity
            ];
            
            // Initialize quantity for this group
            $this->quantities[$this->selectedGroupInventoryVariable] = 1;
            
            // Reset the selector
            $this->selectedGroupInventoryVariable = '';
            
            session()->flash('success', 'تم إضافة العرض بنجاح');
        }
    }

    public function removeGroupFromSelection($groupId)
    {
        unset($this->selectedGroups[$groupId]);
        unset($this->quantities[$groupId]);
        
        $this->submitOrder();
    }

    public function updateGroupQuantity($groupId, $quantity)
    {
        if ($quantity > 0) {
            $this->quantities[$groupId] = $quantity;
            $this->selectedGroups[$groupId]['quantity'] = $quantity;
            $this->submitOrder();
        }
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->selectedGroups as $groupId => $group) {
            $quantity = $this->quantities[$groupId] ?? 1;
            $total += $group['price'] * $quantity;
        }
        return $total;
    }

    public function clearAllSelections()
    {
        $this->reset(['selectedGroups', 'quantities']);
        $this->submitOrder();

    }

    private function submitOrder()
    {
        // if (empty($this->selectedGroups)) {
        //     session()->flash('error', 'يرجى اختيار عرض واحد على الأقل');
        //     return;
        // }

        // Validate inventory for all selected groups
        foreach ($this->selectedGroups as $groupId => $group) {
            $quantity = $this->quantities[$groupId] ?? 1;
            
            foreach ($group['details'] as $detail) {
                $groupQuantity = $detail->details($detail->source)['quantity'];
                $inventoryQuantity = $detail->details($detail->source)['inventory_quantity'];
                $calculatedQuantity = $groupQuantity * $quantity;
                
                if ($calculatedQuantity > $inventoryQuantity) {
                    session()->flash('error', 'المخزون غير كافي للعنصر: ' . $detail->details($detail->source)['name'] . ' في العرض: ' . $group['name']);
                    return;
                }
            }
        }
        
        $this->dispatch('groupAdded',$this->selectedGroups , $this->getTotalPrice());
        
    }

    #[On('resetQuantities')]
    public function resetQuantities()
    {
        $this->reset(['selectedGroupInventoryVariable','selectedGroups','quantities']);
    }
    public function render()
    {
        return view('livewire.sales.groups-selector');
    }
}