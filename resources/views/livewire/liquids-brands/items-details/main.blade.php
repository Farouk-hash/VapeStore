@extends('dashboard.layouts.master')

@section('css')

<style>
    /* Base Card Styles */
.flavour-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.flavour-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.flavour-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 10px 10px 0 0;
}

.flavour-title {
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}

.liquid-options {
    padding: 20px;
}

/* Option Selector Styles */
.option-selector {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.option-group {
    margin-bottom: 15px;
}

.option-group:last-child {
    margin-bottom: 0;
}

.option-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 14px;
}

.option-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

/* Option Button Styles - Removed !important declarations */
.option-btn {
    padding: 6px 12px;
    border: 2px solid #dee2e6;
    background: white;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    min-width: 60px;
    text-align: center;
    /* Ensure button maintains its clickable nature */
    position: relative;
    z-index: 1;
}

.option-btn:hover {
    border-color: #007bff;
    background: #e3f2fd;
}

.option-btn.active {
    background: #007bff;
    border-color: #007bff;
    color: white;
}

.option-btn.vape-mtl.active {
    background: #28a745;
    border-color: #28a745;
}

.option-btn.vape-dl.active {
    background: #dc3545;
    border-color: #dc3545;
}

.option-btn.nic-salt.active {
    background: #17a2b8;
    border-color: #17a2b8;
}

.option-btn.nic-freebase.active {
    background: #6f42c1;
    border-color: #6f42c1;
}

.option-btn.unavailable {
    border-color: #f8d7da;
    background: #f8f9fa;
    color: #6c757d;
    border-style: dashed;
    opacity: 0.7;
}

.option-btn.unavailable:hover {
    border-color: #dc3545;
    background: #f5c6cb;
    color: #721c24;
}

.option-btn.unavailable.active {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
    border-style: solid;
}

/* Liquid Details */
.liquid-details {
    background: #ffffff;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 15px;
    margin-top: 15px;
    display: none;
}

.liquid-details.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.detail-item {
    text-align: center;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 6px;
}

.detail-value {
    font-size: 16px;
    font-weight: 700;
    color: #007bff;
    display: block;
}

.detail-label {
    font-size: 11px;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
    margin-top: 5px;
}

/* Stats Row */
.stats-row {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 28px;
    font-weight: bold;
    color: #007bff;
}

.stat-label {
    font-size: 12px;
    color: #6c757d;
    text-transform: uppercase;
    font-weight: 600;
}

/* Strength Management */
.strengths-container {
    background: #e3f2fd;
    padding: 15px;
    border-radius: 6px;
    margin-top: 15px;
}

.strength-item {
    display: inline-flex;
    align-items: center;
    margin: 2px;
    background: linear-gradient(45deg, #007bff, #0056b3);
    border-radius: 15px;
    overflow: hidden;
}

.strength-badge {
    display: inline-block;
    color: white;
    padding: 4px 12px;
    font-size: 11px;
    font-weight: bold;
    margin: 0;
}

.strength-actions {
    display: flex;
    background: rgba(255,255,255,0.2);
}

.strength-btn {
    background: none;
    border: none;
    color: white;
    padding: 4px 6px;
    cursor: pointer;
    font-size: 10px;
    transition: background 0.2s;
}

.strength-btn:hover {
    background: rgba(255,255,255,0.3);
}

.strength-input {
    display: none;
    margin: 5px 0;
}

.strength-input input {
    width: 80px;
    padding: 4px 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 11px;
}

.strength-input button {
    padding: 4px 8px;
    margin-left: 5px;
    border: none;
    border-radius: 4px;
    font-size: 10px;
    cursor: pointer;
}

.strength-save {
    background: #28a745;
    color: white;
}

.strength-cancel {
    background: #6c757d;
    color: white;
}

/* Main Action Buttons - Removed !important to allow Livewire control */
.add-liquid-btn {
    background: linear-gradient(45deg, #17a2b8, #138496);
    border: none;
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    margin: 15px auto;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
    text-align: center;
    display: block;
}

.add-liquid-btn:hover {
    background: linear-gradient(45deg, #138496, #117a8b);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
}

.add-flavor-main-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    margin: 20px auto;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    text-align: center;
    min-width: 250px;
    display: block;
}

.add-flavor-main-btn:hover {
    background: linear-gradient(45deg, #218838, #1e9b7a);
    transform: translateY(-3px);
    box-shadow: 0 6px 25px rgba(40, 167, 69, 0.4);
}

/* No Match Container */
.no-match-container {
    background: #fff3cd;
    border: 2px dashed #ffc107;
    border-radius: 8px;
    padding: 20px;
    margin: 15px 0;
    text-align: center;
    display: none;
}

.no-match-container.show {
    display: block;
    animation: slideDown 0.3s ease;
}

.no-match-text {
    color: #856404;
    margin-bottom: 15px;
    font-weight: 600;
}

/* Add Flavor Form Container */
.add-flavor-form-container {
    background: #f0f8f0;
    border: 2px solid #28a745;
    border-radius: 12px;
    padding: 25px;
    margin: 20px 0;
}

.add-flavor-form-container.show {
    animation: slideDown 0.4s ease;
}

.add-flavor-form-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin: -25px -25px 20px -25px;
    text-align: center;
}

.add-flavor-form-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

/* Form Sections */
.flavor-form-section {
    background: white;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
}

.flavor-form-section-title {
    font-size: 16px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e9ecef;
}

.flavor-form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 15px;
}

.flavor-form-group {
    display: flex;
    flex-direction: column;
}

.flavor-form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 14px;
}

/* Form Inputs */
.flavor-form-input {
    padding: 10px 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.flavor-form-input:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.flavor-form-select {
    padding: 10px 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    background-color: white;
    transition: all 0.2s;
}

.flavor-form-select:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

/* Liquid Form Styles */
.liquid-form-container {
    background: #e8f4fd;
    border: 2px solid #17a2b8;
    border-radius: 8px;
    padding: 20px;
    margin: 15px 0;
    display: none;
}

.liquid-form-container.show {
    display: block;
    animation: slideDown 0.3s ease;
}

.liquid-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.liquid-form-group {
    display: flex;
    flex-direction: column;
}

.liquid-form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    font-size: 13px;
}

.liquid-form-input {
    padding: 8px 12px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    font-size: 13px;
    transition: border-color 0.2s;
}

.liquid-form-input:focus {
    outline: none;
    border-color: #17a2b8;
}

/* Multiple Selection Containers */
.vape-styles-container, 
.nicotine-types-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 5px;
}

.style-checkbox {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    border: 2px solid #dee2e6;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s;
    background: white;
    /* Ensure clickability for Livewire */
}

.style-checkbox:hover {
    border-color: #28a745;
    background: #f8f9fa;
}

.style-checkbox.selected {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

.style-checkbox input {
    margin-right: 8px;
}

/* Strengths Builder */
.strengths-builder {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

.strengths-list-builder {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
    min-height: 40px;
    align-items: flex-start;
}

.strength-tag {
    display: inline-flex;
    align-items: center;
    background: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.strength-tag .remove-strength {
    margin-left: 8px;
    background: rgba(255,255,255,0.3);
    border: none;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 10px;
    transition: background 0.2s;
}

.strength-tag .remove-strength:hover {
    background: rgba(255,255,255,0.5);
}

.strength-input-builder {
    display: flex;
    gap: 10px;
    align-items: center;
}

.strength-input-builder input {
    width: 100px;
    padding: 8px 12px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    font-size: 13px;
}

.add-strength-builder-btn {
    background: #17a2b8;
    border: none;
    color: white;
    padding: 8px 15px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.add-strength-builder-btn:hover {
    background: #138496;
}

/* Form Action Buttons */
.liquid-form-actions,
.flavor-form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
}

.liquid-form-btn,
.flavor-form-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    min-width: 120px;
    /* Ensure buttons are clickable */
    position: relative;
    z-index: 2;
}

.liquid-form-save,
.flavor-form-save {
    background: #28a745;
    color: white;
}

.liquid-form-save:hover,
.flavor-form-save:hover {
    background: #218838;
    transform: translateY(-1px);
}

.liquid-form-cancel,
.flavor-form-cancel {
    background: #6c757d;
    color: white;
}

.liquid-form-cancel:hover,
.flavor-form-cancel:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

.custom-vg-pg {
    display: none;
}

/* Loading States */
.loading {
    opacity: 0.7;
    pointer-events: none;
}

/* Inventory Management */
.inventory-management {
    margin-top: 0; /* remove extra spacing */
    text-align: right; /* keep buttons aligned to the right */
    padding-top: 0;
    border-top: none;
}
.inventory-management .btn {
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.inventory-management .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}



</style>

@endsection


@section('content')
    <div>
        <livewire:liquids-brands.items-details.index :item-id="$itemID" />
    </div>

@endsection

@section('js')

@endsection