import React from 'react';
import Widget from '../widget/widget';
import { 
	CTAContainer, 
	CTAWrapper, 
	CTAHeaderText,
	CTANumber
} from './cta.styles';

function CTA() {
	return (
		<CTAContainer>
			<CTAWrapper className="container d-flex d-fd-column d-j-cnt d-a-cnt">
				{/* CTA HEADER */}
				<CTAHeaderText>Ready To Get Started?</CTAHeaderText>
				
				{/* Widget */}
				<Widget style={{ color: 'var(--white)' }} />

				{/*  CTA Number */}
				<CTANumber>Call Us Toll Free: +972543312222</CTANumber>
			</CTAWrapper>
		</CTAContainer>
	)
}

export default CTA;