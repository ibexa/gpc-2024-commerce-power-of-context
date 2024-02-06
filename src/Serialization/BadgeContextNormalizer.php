<?php

namespace App\Serialization;

use App\Value\BadgeContext;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BadgeContextNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    /**
     * @param \App\Value\BadgeContext $object
     *
     * @return array<string, mixed>
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'caption' => $object->getCaption(),
            'color' => $object->getColor(),
            'shape' => $object->getShape(),
            'hasBorder' => $object->hasBorder(),
            'hasFireworks' => $object->hasFireworks(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof BadgeContext;
    }

    public function denormalize($data, string $type, string $format = null, array $context = []): BadgeContext
    {
        return new BadgeContext(
            $data['caption'],
            $data['color'],
            $data['shape'],
            $data['hasBorder'],
            $data['hasFireworks']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === BadgeContext::class;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
