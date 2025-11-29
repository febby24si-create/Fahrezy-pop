<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleUpload extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';

    protected $fillable = [
        'filename',
        'original_name',
        'file_path',
        'ref_table',
        'ref_id'
    ];

    /**
     * Scope untuk mendapatkan file berdasarkan referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
            ->where('ref_id', $refId);
    }

    /**
     * Get file type
     */
    public function getFileTypeAttribute()
    {
        $extension = strtolower(pathinfo($this->original_name, PATHINFO_EXTENSION));

        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $videoTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'];
        $documentTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];

        if (in_array($extension, $imageTypes)) {
            return 'image';
        } elseif (in_array($extension, $videoTypes)) {
            return 'video';
        } elseif (in_array($extension, $documentTypes)) {
            return 'document';
        } else {
            return 'other';
        }
    }

    /**
     * Check if file is image
     */
    public function getIsImageAttribute()
    {
        return $this->file_type === 'image';
    }

    /**
     * Check if file is video
     */
    public function getIsVideoAttribute()
    {
        return $this->file_type === 'video';
    }

    /**
     * Check if file is document
     */
    public function getIsDocumentAttribute()
    {
        return $this->file_type === 'document';
    }
}
