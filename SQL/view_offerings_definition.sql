select  o.offeringIdPk AS offeringIdPk,
        b.businessName AS businessName,
        o.offeringName AS offeringName,
        i.interestAreaName AS interestAreaName,
        l.locationName AS locationName,
        o.offeringDescription AS offeringDescription,
        o.offeringDetails AS offeringDetails,
        o.offeringCulturalBenefits AS offeringCulturalBenefits,
        o.offeringAwards AS offeringAwards,
        op.offeringPriceRangeDescription AS offeringPriceRangeDescription,
        o.offeringImage AS offeringImage,
        sum(v.vote = 1) AS yesVotes,
        sum(v.vote = 0) AS noVotes,
        sum(v.vote = 1) - sum(v.vote = 0) AS displayVotes 
from    (((((cultureconnect.offering o 
        join cultureconnect.business b on(o.businessIdPk = b.businessIdPk))
        join cultureconnect.interestarea i on(o.offeringCategory = i.interestAreaIdPk)) 
        join cultureconnect.location l on(o.locationIdPk = l.locationIdPk)) 
        join cultureconnect.offeringpricing op on(o.offeringPriceRange = op.offeringPriceRange)) 
        left join cultureconnect.vote v on(v.offeringIdPk = o.offeringIdPk)) 
group by o.offeringIdPk