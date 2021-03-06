<?php

namespace Statamic\Contracts\Assets;

use Statamic\Contracts\Data\Data;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface Asset extends Data
{
    /**
     * Get the filename
     *
     * @return string
     */
    public function filename();

    /**
     * Get or set the basename
     *
     * @param string|null $basename
     * @return string
     */
    public function basename($basename = null);

    /**
     * Get or set the folder
     *
     * @param string|null $folder
     * @return \Statamic\Contracts\Assets\AssetFolder
     */
    public function folder($folder = null);

    /**
     * Get or set the container
     *
     * @param null|string $id  ID of the container, if setting.
     * @return \Statamic\Contracts\Assets\AssetContainer
     */
    public function container($id = null);

    /**
     * Get the URL
     *
     * @return string
     */
    public function url();

    /**
     * Get either a image URL builder instance, or a URL if passed params.
     *
     * @param null|array $params Optional manipulation parameters to return a string right away
     * @return \Statamic\Contracts\Imaging\UrlBuilder|string
     */
    public function manipulate($params = null);

    /**
     * Is this asset an image?
     *
     * @return bool
     */
    public function isImage();

    /**
     * Get the file extension
     *
     * @return string
     */
    public function extension();

    /**
     * Get the last modified date
     *
     * @return \Carbon\Carbon
     */
    public function lastModified();

    /**
     * Upload a file
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return mixed
     */
    public function upload(UploadedFile $file);

    /**
     * Transform into an array
     *
     * @return array
     */
    public function toArray();
}
