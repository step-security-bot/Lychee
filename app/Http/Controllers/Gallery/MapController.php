<?php

namespace App\Http\Controllers\Gallery;

use App\Actions\Album\PositionData as AlbumPositionData;
use App\Actions\Albums\PositionData as RootPositionData;
use App\Http\Requests\Map\MapDataRequest;
use App\Http\Resources\Collections\PositionDataResource;
use App\Http\Resources\GalleryConfigs\MapProviderData;
use App\Models\Configs;
use Spatie\LaravelData\Data;

class MapController
{
	private RootPositionData $rootPositionData;
	private AlbumPositionData $albumPositionData;

	public function __construct()
	{
		$this->rootPositionData = resolve(RootPositionData::class);
		$this->albumPositionData = resolve(AlbumPositionData::class);
	}

	public function getProvider(): Data
	{
		return new MapProviderData();
	}

	/**
	 * Return an image and the timeout if the frame is supported..
	 *
	 * @param MapDataRequest $request
	 *
	 * @return PositionDataResource
	 */
	public function getData(MapDataRequest $request): Data
	{
		$album = $request->album();

		if ($album === null) {
			return $this->rootPositionData->do();
		}

		$includeSubAlbums = Configs::getValueAsBool('map_include_subalbums');

		return $this->albumPositionData->get($album, $includeSubAlbums);
	}
}