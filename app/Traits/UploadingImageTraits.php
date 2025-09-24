<?php
namespace App\Traits;

use App\Models\Image\Image;
use Illuminate\Http\UploadedFile;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

trait UploadingImageTraits
{
    /**
     * Handle file upload from Request or Livewire.
     *
     * @param mixed  $source              Request|TemporaryUploadedFile|array
     * @param string $input_name          request input name OR Livewire property name
     * @param string $foldername          storage folder
     * @param string $disk                storage disk
     * @param int    $imageable_id        related model ID
     * @param string $imageable_type      related model type
     * @param string $request_input_variable for naming
     * @return bool
     */
    public function uploadImage(
        $source,
        $input_name,
        $foldername,
        $disk,
        $imageable_id,
        $imageable_type,
        $request_input_variable = "name"
    ) {
        $files = [];

        // Case 1: Request (classic form)
        if ($source instanceof \Illuminate\Http\Request && $source->hasFile($input_name)) {
            $files = $source->file($input_name);
            Log::info('instance Of');
        }

        // Case 2: Livewire property (single or multiple)
        elseif ($source instanceof TemporaryUploadedFile || $source instanceof UploadedFile) {
            $files = [$source];
        }

        // Case 3: Array of files (multi-upload in Livewire or Request)
        elseif (is_array($source)) {
            $files = $source;
        }

        if (empty($files)) {
            return false;
        }

        // Normalize files to array
        if (!is_array($files) || $files instanceof UploadedFile) {
            $files = [$files];
        }

        // Name prefix (slug)
        $name = $source instanceof \Illuminate\Http\Request
            ? Str::slug($source->input($request_input_variable, 'file'))
            : Str::slug($request_input_variable);

        foreach ($files as $index => $file) {
            $fileName = $name . '-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();

            // Save DB record
            Image::create([
                'url'            => $fileName,
                'imageable_id'   => $imageable_id,
                'imageable_type' => $imageable_type
            ]);

            // Store
            $file->storeAs($foldername, $fileName, $disk);
        }

        return true;
    }

    /**
     * Delete files + DB records
     */
    public function deleteImage(array $file_names, $folderName, $disk, $imageable_id, $imageable_type)
    {
        $deletedAll = true;

        foreach ($file_names as $file_name) {
            $file_path = $folderName . '/' . $file_name;

            if (Storage::disk($disk)->exists($file_path)) {
                if (Storage::disk($disk)->delete($file_path)) {
                    Image::where('imageable_id', $imageable_id)
                        ->where('imageable_type', $imageable_type)
                        ->where('url', $file_name)
                        ->delete();
                } else {
                    $deletedAll = false;
                }
            } else {
                $deletedAll = false;
            }
        }

        return $deletedAll;
    }
}
